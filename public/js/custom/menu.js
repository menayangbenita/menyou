let parent = document.getElementById('bahan');
let list_barang;

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('addItem').addEventListener('click', () => {addList()});
});

function refreshEvent() {
    document.querySelectorAll('#bahan input.nama-bahan').forEach((input) => {
        input.onchange = () => {
            let barang = daftar_barang.find(item => item.nama == input.value); 

            if (input.value != '' && !barang) {
                alert(`Data ${input.value} tidak ada di dalam daftar barang/stok!`);
                input.value = '';
            } else if (list_barang.find(item => item == input.value)) {
                alert(`Data ${input.value} sudah ada di dalam list!`);
                input.value = '';
            } else {
                updateSatuan(input, (barang) ? barang.satuan : '..')
                updateList();
            }

        };
    });

    document.querySelectorAll('#bahan input.jumlah-bahan').forEach(input => {
        input.oninput = () => {
            let num = '1234567890.'.split('');
            let inputChar = input.value.split('');
            inputChar = inputChar.filter(char => num.includes(char));
            input.value = inputChar.join('');
        }
    });

    document.querySelectorAll('#bahan .removeItem').forEach(btn => {
        btn.onclick = () => {
            if (parent.childElementCount > 1) {
                btn.parentElement.parentElement.parentElement.remove();
                refreshEvent();
            }
        };
    });

    updateList();
}

function addList(nama = '', jumlah = '', satuan = '..') {
    let list = document.createElement('div');
    list.setAttribute('class', 'row mb-2');
    list.innerHTML = `
        <div class="col-sm-6">
            <div class="input-group">
                <button class="btn btn-icon btn-danger m-0 px-3 removeItem" type="button">
                    <i class="fa fa-xmark"></i>
                </button>
                <input type="text" class="form-control form-control-solid ps-2 nama-bahan" name="nama_bahan[]" value="${nama}" placeholder="Nama Bahan" list="barang" autocomplete="off">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="input-group d-flex">
                <input type="text" class="form-control form-control-solid position-static rounded-end-0 jumlah" name="jumlah_bahan[]" value="${jumlah}" placeholder="0">
                <span class="input-group-text position-static satuan border-0">${satuan}</span>
            </div>
        </div>
    `;
    parent.appendChild(list);
    refreshEvent();
}

function updateList() {
    list_barang = [];
    document.querySelectorAll('#bahan input.nama-bahan').forEach((input) => {
        if (input.value != '') list_barang.push(input.value);
    });
}

function updateSatuan(input, value) {
    const parent = input.parentElement.parentElement.parentElement;
    parent.querySelector('span.satuan').innerText = value;
}
