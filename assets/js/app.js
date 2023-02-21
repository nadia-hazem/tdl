
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
        const li = document.createElement("li");
        li.innerText = task.task;

        // Créer le bouton de suppression
        const deleteButton = document.createElement("button");
        deleteButton.classList.add("rouge", "btn", "btn-sm", "btn-outlin");
        deleteButton.setAttribute("id", task.id);
        deleteButton.innerText = " ❌";
        deleteButton.style.border = "none";
        deleteButton.addEventListener("click", function() {
            deleteTask(this.getAttribute("id"));
        });

        // Créer le bouton de basculement
        const toggleButton = document.createElement("button");
        toggleButton.classList.add("vert", "btn", "btn-sm", "btn-outlin");
        toggleButton.setAttribute("id", task.id);
        toggleButton.innerText = " ✅";
        toggleButton.style.border = "none";
        toggleButton.addEventListener("click", function() {
            // Récupérer l'ID de la tâche
            let id = this.getAttribute("id");
            //fonction pour basculer la tâche
            toggleTask(id);
        });

        // ajouter les boutons si besoin
        if (task.state == 1) {
            // Ajouter le bouton de suppression
            li.appendChild(deleteButton);
        } else {
            // Ajouter le bouton de suppression et de basculement
            li.appendChild(deleteButton);
            li.appendChild(toggleButton);
        }


        return li;
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
                const li = createTaskElement(data[i]);
                if (data[i].state == 1) {
                    doneList.appendChild(li);

                } else {
                    todoList.appendChild(li);
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
