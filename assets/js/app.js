// Attendre que le DOM soit prêt
document.addEventListener("DOMContentLoaded", function() {

    // Sélectionner les éléments du DOM nécessaires
    const todoForm = document.querySelector("#todoForm");
    const todoList = document.querySelector("#todoList");
    const doneList = document.querySelector("#doneList");
    const btnAdd = document.querySelector("#addTask");

    // Fonction pour créer un élément de liste avec un bouton de suppression et de basculement
    function createTaskElement(task) {
        // Créer l'élément de liste
        let tr = document.createElement("tr");
        let tdText = document.createElement("td");
        tdText.innerText = ' ⚑ ' + task.task;
        let tdDate = document.createElement("td");
        let tdBtns = document.createElement("td");

        // Créer le bouton de basculement
        const toggleButton = document.createElement("button");
        toggleButton.classList.add("btn", "btn-sm");
        toggleButton.setAttribute("id", task.id);
        toggleButton.innerText = " ✅";
        toggleButton.style.border = "none";
        toggleButton.addEventListener("click", function() {
            // Récupérer l'ID de la tâche
            let id = this.getAttribute("id");
            //fonction pour basculer la tâche
            toggleTask(id);
        });

        // Créer le bouton de suppression
        const deleteButton = document.createElement("button");
        deleteButton.classList.add("btn", "btn-sm");
        deleteButton.setAttribute("id", task.id);
        deleteButton.innerText = " ❌";
        deleteButton.style.border = "none";
        deleteButton.addEventListener("click", function() {
            deleteTask(this.getAttribute("id"));
        });
        // Ajouter les 3 <td> à la <tr>
        tr.appendChild(tdText);
        tr.appendChild(tdDate);
        tr.appendChild(tdBtns);

        // condition d'affichage des boutons suppr. et bascule
        if (task.state == 1) {
            tdDate.innerText = " ⏵ " + task.dateStart + " ⏯ " + task.dateEnd;
            // Ajouter le bouton de suppression
            tdBtns.appendChild(deleteButton);
        } else {
            tdDate.innerText = " 📅 " + task.dateStart;
            // Ajouter le bouton de suppression et de basculement
            tdBtns.appendChild(deleteButton);
            tdBtns.appendChild(toggleButton);
        }
        return tr;
    }

    // Fonction pour ajouter une tâche à la liste des tâches à faire
    function addTask() {
        let data = new FormData(todoForm);
        fetch("manageTask.php", {
            method: "POST",
            body: data
        })
        .then((response) => response.text())
        .then((data) => {
            data = data.trim();
            if (data == "ok") {
                todoForm.reset();
                displayTasks();
            } else {
                todoForm.nextElementSibling.innerHTML = "erreur";
            }
        })
        .catch((error) => {
            console.log(error);
        });
    }

    function displayTasks() {
        fetch("traitement.php", {
            method: "GET"
        })
        .then((response) => response.json())
        .then((data) => {
            todoList.innerHTML = "";
            doneList.innerHTML = "";
            for (let i = 0; i < data.length; i++) {
                const td = createTaskElement(data[i]);
                if (data[i].state == 1) {
                    doneList.appendChild(td);

                } else {
                    todoList.appendChild(td);
                }
            }
        })
        .catch((error) => {
            console.log(error);
        });
    }

    // Fonction pour supprimer une tâche
    function deleteTask(id) {
        let data = new FormData();
        data.append("id", id);
        data.append("action", "delete");
        fetch("manageTask.php", {
            method: "POST",
            body: data
        })
        .then((response) => response.text())
        .then((data) => {
            data = data.trim();
            if (data == "ok") {
                // on display les tâches
                displayTasks();
            } else {
                todoForm.nextElementSibling.innerHTML = "erreur";
            }
        })
        .catch((error) => {
            console.log(error);
        });
    }

    // Fonction pour basculer une tâche
    function toggleTask(id) {
        let data = new FormData();
        data.append("id", id);
        data.append("action", "toggle");
        fetch("manageTask.php", {
            method: "POST",
            body: data
        })
        .then((response) => response.text())
        .then((data) => {
            data = data.trim();
            if (data == "ok") {
                // on display les tâches
                displayTasks();
            } else {
                todoForm.nextElementSibling.innerHTML = "erreur";
            }
        })
        .catch((error) => {
            console.log(error);
        });
    }

    displayTasks();

    // Fonction pour gérer la soumission du formulaire
    todoForm.addEventListener("submit", function(event) {
        // Empêcher le rechargement de la page
        event.preventDefault();

        // Ajouter la tâche à la liste des tâches à faire
        addTask();
    });
});
