const requestPrepare = document.getElementById('request-prepare');
const addButtons = document.querySelectorAll(".addList");
const form = document.getElementById("formPrepare");
const submitButton = document.getElementById("submit-request");
const textarea = document.querySelector("textarea#deskripsi");
const table = document.getElementById("table-no-export");
let selected_item = []

document.addEventListener('DOMContentLoaded', () => {
    addButtons.forEach(button => {
        button.addEventListener('click', () => {
            const tersedia = JSON.parse(button.dataset.tersedia);
            const id = parseInt(button.dataset.id);
            const stok_id = parseInt(button.dataset.stok_id);
            const nama = button.dataset.nama;
            
            
            console.log(tersedia);
            

            if (tersedia) {
                const find = selected_item.find(index => (index.id == id));
                if (!find) {
                    addItem(id, stok_id, nama);
                } else {
                    const amount = find.element.querySelector('input.amount');
                    amount.value = parseInt(amount.value) + 1;
                }
            } else {
                alert('Stok bahan prepare habis!')
            }

        });
    });

    submitButton.addEventListener('click', (e) => {
        e.preventDefault();

        if (selected_item.length && textarea.value != '') {;
            if (confirm('Apakah anda yakin ingin memproses?')) {
                submitButton.setAttribute('disabled', 'true');
                form.submit();
            }
        } else if (textarea.value == '') {
            alert('Silahkan cek kembali!');
        } else {
            alert('List kosong!');
        }
    });
});

function refreshPrepare() {
    table.querySelectorAll("tr.bg-warning-subtle").forEach(tr => {
        tr.classList.remove('bg-warning-subtle');
    });

    if (selected_item.length) {
        const allAmountInput = document.querySelectorAll('input.amount');
        const allDeleteBtn = document.querySelectorAll('button.removeList');
    
        allDeleteBtn.forEach(btn => {
            btn.onclick = () => {
                removeItem(btn);
            }
        });

        selected_item.forEach(item => {
            table.querySelector(`button.addList[data-id="${item.id}"]`)
                .closest('tr')
                .classList.add('bg-warning-subtle');
        });

        if (window.innerWidth >= 992) allAmountInput[allAmountInput.length - 1].focus();
    }
}

function addItem(id, stok_id, nama) {
    let item = document.createElement('div');
    item.setAttribute('class', 'row g-2');
    item.dataset.id = id;
    item.innerHTML= `
        <div class="col-8">
            <input type="hidden" name="id[]" value="${id}">
            <input type="hidden" name="stok_id[]" value="${stok_id}">
            <div class="input-group mb-3">
                <button class="btn btn-danger m-0 removeList" type="button">
                    <i class="fa fa-xmark"></i>
                </button>
                <input type="text" class="form-control ps-3" name="item[]" value="${nama}" readonly>
            </div>
        </div>
        <div class="col-4">
            <input type="number" class="amount form-control ps-2" name="amount[]" value="1" min="1">
        </div>
    `;

    requestPrepare.append(item);

    selected_item.push({
        id: id,
        element: item,
    });

    refreshPrepare();
}

function removeItem(button) {
    let item = button.closest('.row');
    let findIndex = selected_item.findIndex(index => (index.id == item.dataset.id));

    selected_item.splice(findIndex, 1);
    item.remove();

    refreshPrepare();
}
