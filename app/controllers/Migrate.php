<?php

class Migrate extends Controller
{
	protected $model_name = "Databases";
	protected $folderPath = '../app/database'; // Relative to root folder (public)

	public function __construct() {
		if (ENV != 'Local') redirectTo('/http/notfound', 404);
	}

	public function index()
	{
		$data['files'] = [];

		$files = scandir($this->folderPath);
		if ($files) {
			unset($files[0]);
			unset($files[1]);

			$data['files'] = array_values($files);
		}

		$data['tables'] = $this->model($this->model_name)->getAllTables();

		if (!empty($data['tables'])) {
			array_unshift($data['tables'], [
				'name' => 'database', 
				"rows" => count($data['tables'])
			]);
		}

		$this->view('templates/_migrate', $data);
	}

	public function export($filename)
	{
		try {
			$sqlFilePath = "{$this->folderPath}/{$filename}";
			$sqlQueries = explode(';', file_get_contents($sqlFilePath));

			if ($filename == 'database.sql') {
				$tables = $this->model($this->model_name)->getAllTables();
				foreach ($tables as $table) $this->model($this->model_name)->drop($table['name']);
				$this->model($this->model_name)->import($sqlQueries);

				Flasher::setFlash('<b>SUCCESS</b> to migrate all table!', 'success');
			} else {
				$table = explode('.', $filename)[0];
				$this->model($this->model_name)->drop($table);
				$this->model($this->model_name)->import($sqlQueries);
				
				Flasher::setFlash("<b>SUCCESS</b> to migrate table <i>". $table ."</i>!", 'success');
			}
		} catch (Exception $e) {
			Flasher::setFlash("Migration <b>FAILED</b>! message: <pre>$e</pre>", 'danger');
		}
		redirectTo('/migrate');
	}

	public function import($target)
	{
		try {
			$mysqldump = explode('/public', $_SERVER['DOCUMENT_ROOT'], 2)[0] . '/core/mysqldump';
			$sqlFilePath = "{$this->folderPath}/{$target}";

			$command = ($target == 'database') ? 
				"\"{$mysqldump}\" --host=". DB_HOST ." --user=". DB_USER ." ". DB_NAME ." > {$sqlFilePath}.sql" :
				"\"{$mysqldump}\" --host=". DB_HOST ." --user=". DB_USER ." ". DB_NAME ." ". $target ." > {$sqlFilePath}.sql";

			exec($command, $output, $returnVar);

			if ($returnVar === 0) {
				($target == 'database') ? 
					Flasher::setFlash("<b>SUCCESS</b> to import all tables!", 'success') :
					Flasher::setFlash("<b>SUCCESS</b> to import table <i>". $target ."</i>!", 'success');
			} else {
				throw new Exception("Error creating database backup!");
			}
		} catch (Exception $e) {
			Flasher::setFlash("Import <b>FAILED</b>! message: <pre>$e</pre>", 'danger');
		}
		redirectTo('/migrate');
	}

	public function delete($filename)
	{
		try {
			$sqlFilePath = "{$this->folderPath}/{$filename}";
			if (file_exists($sqlFilePath)) {
				$restricted_file = ['table_template.sql', 'users.sql'];

				if (!in_array($filename, $restricted_file)) {
					unlink($sqlFilePath);
					Flasher::setFlash("<b>SUCCESS</b> to delete {$filename}!", 'success');
				} else {
					Flasher::setFlash("Cannot delete <b>table_template.sql</b> or <b>users.sql</b>!", 'warning');
				}
			} else {
				Flasher::setFlash("File not exist!", 'warning');
			}
		} catch (Exception $e) {
			Flasher::setFlash("<b>ERROR</b>! message: <pre>$e</pre>", 'danger');
		}
		redirectTo('/migrate');
	}

	public function drop($target)
	{
		try {
			if ($target == "database") {
				$tables = $this->model($this->model_name)->getAllTables();
				foreach ($tables as $table) $this->model($this->model_name)->drop($table['name']);
				Flasher::setFlash("<b>SUCCESS</b> to drop all table!", 'success');
			} else {
				$this->model($this->model_name)->drop($target);
				Flasher::setFlash("<b>SUCCESS</b> to drop table <i>". $target ."</i>!", 'success');
			}
		} catch (Exception $e) {
			Flasher::setFlash("Drop <b>FAILED</b>! message: <pre>$e</pre>", 'danger');
		}
		redirectTo('/migrate');
	}

	public function empty($target)
	{
		try {
			$this->model($this->model_name)->truncate($target);
			Flasher::setFlash("<b>SUCCESS</b> to empty table <i>". $target ."</i>!", 'success');
		} catch (Exception $e) {
			Flasher::setFlash("Empty <b>FAILED</b>! message: <pre>$e</pre>", 'danger');
		}
		redirectTo('/migrate');
	}
}
