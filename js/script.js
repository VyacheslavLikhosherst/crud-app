class Edit {
    editBtns = document.querySelectorAll('.edit-item');
    main = document.querySelector('main')
    form = null;
    id = null;
    formDOM = null;

    installingHandlers() {
        this.editBtns.forEach(item => item.addEventListener('click', (event) => this.editRow(event)))
    }

    editRow(event) {
        this.main.insertAdjacentElement('afterend', this.form)
        this.formDOM = document.querySelector('.edit-form')
        let parentTd = event.target.parentNode
        let parentTr = parentTd.parentNode
        this.id = Number(parentTr.firstChild.innerHTML)
        this.formHandler()
    }

    //The function that creates the form
    createForm() {
        this.form = document.createElement('form')
        this.form.className = 'edit-form'
        this.form.setAttribute('action', 'edit.php')
        this.form.setAttribute('method', 'post')
        this.form.innerHTML =
            `<div class="mb-3">
        <label class="form-label">Имя:</label>
        <input type="text" required class="form-control" name="name">
    </div>
    <div class="mb-3">
        <label class="form-label">Возраст:</label>
        <input type="number" required class="form-control" name="age">
    </div>
    <div class="mb-3">
        <label class="form-label">Email:</label>
        <input type="email" required class="form-control" name="email">
    </div>
    <button type="submit" class="btn btn-primary">Изменить</button>`
    }

    formHandler() {
        this.formDOM.addEventListener('submit', (e) => {
            e.preventDefault()
            const formData = new FormData(e.target)
            formData.append('id', `${this.id}`)
            const data = Object.fromEntries(formData.entries());
            axios.post('edit.php', data, {
                headers: {
                    'Content-Type': 'application/json'
                }
            }).then(res => {
                location.reload()
            })
            e.target.remove()
        })
    }
}

class Delete {
    deleteBtns = document.querySelectorAll('.delete-item');
    id = null;


    installingHandlers() {
        this.deleteBtns.forEach(item => item.addEventListener('click', event => this.deleteRow(event)))
    }

    deleteRow(event) {
        let parentTd = event.target.parentNode
        let parentTr = parentTd.parentNode
        this.id = Number(parentTr.firstChild.innerHTML)
        parentTr.remove()
        axios.post(`delete.php`, {id: this.id}, {
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(() => {
                let rows = document.querySelectorAll('.row-item')
                if (rows.length < 1) {
                    location.reload()
                }
            })
    }
}

const edit = new Edit();
edit.installingHandlers();
edit.createForm();

const deleteRow = new Delete();
deleteRow.installingHandlers();


//Buttons for editing and deleting
// const editBtns = document.querySelectorAll('.edit-item'),
//     deleteBtns = document.querySelectorAll('.delete-item');

// deleteBtns.forEach((item, idx) => {
//     item.addEventListener('click', event => deleteRow(event))
// })

// editBtns.forEach(item => {
//     item.addEventListener('click', event => editRow(event))
// })

// const main = document.querySelector('main')
// let form;

//The function that creates the form
// function createForm() {
//     form = document.createElement('form')
//     form.className = 'edit-form'
//     form.setAttribute('action', 'edit.php')
//     form.setAttribute('method', 'post')
//     form.innerHTML =
//         `<div class="mb-3">
//         <label class="form-label">Имя:</label>
//         <input type="text" class="form-control" name="name">
//     </div>
//     <div class="mb-3">
//         <label class="form-label">Возраст:</label>
//         <input type="number" class="form-control" name="age">
//     </div>
//     <div class="mb-3">
//         <label class="form-label">Email:</label>
//         <input type="email" class="form-control" name="email">
//     </div>
//     <button type="submit" class="btn btn-primary">Изменить</button>`
// }
//
// createForm()

// let id;

//Displaying a form for editing
// function editRow(event) {
//     main.insertAdjacentElement('afterend', form)
//     let parentTd = event.target.parentNode
//     let parentTr = parentTd.parentNode
//     id = Number(parentTr.firstChild.innerHTML)
//     console.log(id)
// }

// form.addEventListener('submit', (e) => {
//     e.preventDefault()
//     const formData = new FormData(e.target)
//     formData.append('id', `${id}`)
//     const data = Object.fromEntries(formData.entries());
//     axios.post('edit.php', data, {
//         headers: {
//             'Content-Type': 'application/json'
//         }
//     }).then(res => {
//         location.reload()
//     })
//     e.target.remove()
// })

//Request to delete a record
// function deleteRow(event) {
//     let parentTd = event.target.parentNode
//     let parentTr = parentTd.parentNode
//     let id = Number(parentTr.firstChild.innerHTML)
//     parentTr.remove()
//     axios.post(`delete.php`, {id: id}, {
//         headers: {
//             'Content-Type': 'application/json'
//         }
//     })
//         .then((res) => {
//             let rows = document.querySelectorAll('.row-item')
//             if (rows.length < 1) {
//                 location.reload()
//             }
//         })
// }




