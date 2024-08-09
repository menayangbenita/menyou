<?php

class Model
{
    protected $user;
	protected $db;

	public function __construct()
	{
		$this->db = new Database();
		$this->user = Cookie::get_jwt()->name;
	}

    // Upload & File Handler

    public function storeFile($name, $targetDir = 'upload', $rename = false, $oldFileName = '')
    {
        // Get file data
        $file = $_FILES[$name];

        if ($file['error'] !== 4) {
            // Sanitize target dir
            $targetDir = rtrim($targetDir, '/');

            // Delete old file
            if (!empty($oldFileName)) 
				$this->deleteFile("{$targetDir}/{$oldFileName}");

            // Get file extension
            $imageFileType = explode('.', $file['name']);
			$imageFileType = strtolower(end($imageFileType));

            // Rename file with uniqid
            $filename = ($rename ? $rename : uniqid()) . ".{$imageFileType}";

            // Move uploaded file into target dir
            move_uploaded_file($file['tmp_name'], "{$targetDir}/{$filename}");
            
            return $filename;
        }

        return $oldFileName;
    }
    
    public function validateFiles($files = [])
    {
        foreach ($files as $name => $options) {
            // Get file data
            $file = $_FILES[$name];

            // Get options
            if (is_string($options))
                $options = explode('|', trim($options, '|'));

            // Check file requirement
            $required = in_array('required', $options);

            if ($required && $file['error'] === 4)
                return false;
            elseif (!$required && $file['error'] === 4)
                return true;

            // Explore each option
            foreach ($options as $option) {
                // Get validation type and args
                $option = explode(':', $option, 2);

                $type = strtolower($option[0]);
                $args = isset($option[1]) ? $option[1] : '';
                
                $validate = match ($type) {
                    'type' => function($file, $args) {
                        // Get file extension
                        $fileType = explode('.', $file['name']);
                        $fileType = strtolower(end($fileType));

                        // Check file extension
                        $allowedTypes = explode(',', $args);
                        return in_array($fileType, $allowedTypes);
                    },
                    'mime' => function($file, $args) {
                        // Get file mime
                        $fileMime = $file['type'];

                        // Check file mime
                        $allowedMimes = explode(',', strtolower($args));
                        return in_array($fileMime, $allowedMimes);
                    },
                    'size' => function($file, $args) {
                        // Get file size
                        $fileSize = $file['size'];

                        // Check file size
                        $args = explode('*', $args, 2);

                        if (count($args) == 2 && strlen($args[1]) == 2) {
                            $maxFileSize = floatval($args[0]) * constant($args[1]);
                            return $fileSize <= $maxFileSize;
                        }
                        return false;
                    },
                    default => 'skip'
                };

                $result = $validate($file, $args);

                if (is_bool($result) && !$result) 
                    return false;
            }
        }

        return true;
    }

    public function deleteFile($filepath)
    {
        if (file_exists($filepath)) 
			unlink($filepath);
    }
}