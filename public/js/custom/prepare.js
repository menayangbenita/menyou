const requestPrepare = document.getElementById('request-prepare');
const addButtons = document.querySelectorAll(".addRequest");
const form = document.getElementById("formPrepare");
const submitButton = document.getElementById("submit-request");
const textarea = document.querySelector("textarea#deskripsi");
const table = document.getElementById("table-no-export");
let selected_item = []

document.addEventListener('DOMContentLoaded', () => {
    addButtons.forEach(button => {
        button.addEventListener('click', () => {
            const tersedia = parseInt(button.dataset.tersedia);
            const id = parseInt(button.dataset.id);
            const stok_id = parseInt(button.dataset.stok_id);
            const nama = button.dataset.nama;

            if (tersedia > 0) {
                const find = selected_item.find(index => (index.id == id));
                if (!find) {
                    addItem(id, stok_id, nama, tersedia);
                } else {
                    const amount = find.element.querySelector('input.amount');
                    amount.value = parseInt(amount.value) + 1;
                    validateValue(amount);
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

        allAmountInput.forEach(inp => {
            inp.oninput = () => {
                validateValue(inp);
            }
        });
    
        allDeleteBtn.forEach(btn => {
            btn.onclick = () => {
                removeItem(btn);
            }
        });

        selected_item.forEach(item => {
            table.querySelector(`button.addRequest[data-id="${item.id}"]`)
                .closest('tr')
                .classList.add('bg-warning-subtle');
        });

        if (window.innerWidth >= 992) allAmountInput[allAmountInput.length - 1].focus();
    }
}

function validateValue(amount) {
    let name = amount.closest('.row').querySelector('input[name="item[]"]').value;
    let max = parseInt(amount.getAttribute('max'));
    let val = parseInt(amount.value);
    if (val > max) {
        alert(`${name} hanya tersedia maksimum ${max} porsi!`);
        amount.value = max;
    }
}

function addItem(id, stok_id, nama, tersedia) {
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
            <input type="number" class="amount form-control ps-2" name="amount[]" value="1" min="1" max="${tersedia}">
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
