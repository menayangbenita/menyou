<div class="row">
    <div class="col-12">
        <form class="row g-3 align-middle" method="post">
            <div class="col-md-2">
                <label for="filterOption">Periode:</label>
                <select id="filterOption" class="form-control bg-light" name="option">
                    <?php $filterOptions = ['tahunan', 'bulanan', 'mingguan']; ?>
                    <?php foreach ($filterOptions as $opt) : ?>
                        <option value="<?= $opt ?>" <?= ($opt == $data['filter']['option']) ? 'selected' : '' ?>>
                            <?= ucfirst($opt) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div id="filterTahunan" class="col-md-2 <?= (in_array($data['filter']['option'], ['mingguan'])) ? 'hidden' : '' ?>">
                <label for="tahun">Tahun:</label>
                <select id="tahun" class="form-control" name="tahun">
                    <?php for ($tahun = $data['filter']['tahun'] - 2; $tahun <= $data['filter']['tahun'] + 2; $tahun++) : ?>
                        <option value="<?= $tahun ?>" <?= ($tahun == $data['filter']['tahun']) ? 'selected' : '' ?>>
                            <?= $tahun ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>

            <div id="filterBulanan" class="col-md-2 <?= (in_array($data['filter']['option'], ['tahunan', 'mingguan'])) ? 'hidden' : '' ?>">
                <label for="bulan">Bulan:</label>
                <select id="bulan" class="form-control" name="bulan">
                    <?php $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']; ?>
                    <?php foreach ($months as $i => $month) : ?>
                        <option value="<?= $i + 1 ?>" <?= ($i + 1 == $data['filter']['bulan']) ? 'selected' : '' ?>>
                            <?= $month ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-2 filterMingguan <?= (in_array($data['filter']['option'], ['tahunan', 'bulanan'])) ? 'hidden' : '' ?>">
                <label for="minggu-mulai">Tanggal Mulai:</label>
                <input type="date" id="minggu-mulai" class="form-control" name="minggu-mulai" value="<?= $data['filter']['minggu-mulai'] ?>">
            </div>

            <div class="col-md-2 filterMingguan <?= (in_array($data['filter']['option'], ['tahunan', 'bulanan'])) ? 'hidden' : '' ?>">
                <label for="minggu-selesai">Tanggal Selesai:</label>
                <input type="date" id="minggu-selesai" class="form-control" value="<?= $data['filter']['minggu-selesai'] ?>" readonly>
            </div>

            <?php
            // Misalkan BASEURL sudah terdefinisi
            $current_page = basename($_SERVER['REQUEST_URI']);
            ?>

            <div class="col-md-2 mt-4 d-flex align-items-end">
                <button type="submit" class="btn bg-gradient-info mb-0 me-3">
                    <i class="fa fa-search-plus" aria-hidden="true"></i>
                </button>
                <?php if ($current_page == 'penjualan') : ?>
                    <a href="<?= BASEURL ?>/laporan/penjualan" class="btn bg-gradient-info mb-0">
                        <i class="fa fa-xmark" aria-hidden="true"></i>
                    </a>
                <?php elseif ($current_page == 'karyawan') : ?>
                    <a href="<?= BASEURL ?>/laporan/karyawan" class="btn bg-gradient-info mb-0">
                        <i class="fa fa-xmark" aria-hidden="true"></i>
                    </a>
                <?php endif; ?>
            </div>

        </form>
    </div>
</div>

<script>
    function changeFilterOption() {
        // console.log('test ' + opt);
        let opt = $("#filterOption").val();

        if (opt == "tahunan") {
            $("#filterTahunan").removeClass("hidden");
            $("#filterBulanan").addClass("hidden");
            $(".filterMingguan").addClass("hidden");
        } else if (opt == "bulanan") {
            $("#filterTahunan").removeClass("hidden");
            $("#filterBulanan").removeClass("hidden");
            $(".filterMingguan").addClass("hidden");
        } else if (opt == "mingguan") {
            $("#filterTahunan").addClass("hidden");
            $("#filterBulanan").addClass("hidden");
            $(".filterMingguan").removeClass("hidden");
        }
    }

    $(document).ready(function() {
        $("#filterOption").on('change', changeFilterOption);
        $('#minggu-mulai').on('change', function() {
            let firstDate = new Date($(this).val());
            let secondDate = new Date(firstDate);

            secondDate.setDate(firstDate.getDate() + 6);
            // Format secondDate to 'yyyy-mm-dd' for setting value in input
            let formattedSecondDate = secondDate.toISOString().split('T')[0];

            $('#minggu-selesai').val(formattedSecondDate);
        });
    });
</script>