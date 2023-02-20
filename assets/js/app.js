// Attendre que le DOM soit prêt
document.addEventListener("DOMContentLoaded", function() {

    // Sélectionner les éléments du DOM nécessaires
    const todoForm = document.querySelector("#todoForm");
    const taskInput = document.querySelector("#task");
    const todoList = document.querySelector("#todoList");
    const doneList = document.querySelector("#doneList");

    // Fonction pour créer un élément de liste avec un bouton de suppression et de basculement
    function createTaskElement(task) {
        // Créer l'élément de liste
        const li = document.createElement("li");
        li.innerText = task;

        // Créer le bouton de suppression
        const deleteButton = document.createElement("button");
        deleteButton.innerText = " ❌";
        deleteButton.style.border = "none";
        deleteButton.addEventListener("click", function() {
            li.remove();
        });

        // Créer le bouton de basculement
        const toggleButton = document.createElement("button");
        toggleButton.innerText = " ✅";
        toggleButton.style.border = "none";
        toggleButton.addEventListener("click", function() {
            // Supprimer l'élément de la liste des tâches à faire
            li.remove();

            // Ajouter l'élément à la liste des tâches réalisées
            doneList.appendChild(li);

            // Supprimer le bouton de basculement et ré-attacher le bouton de suppression
            toggleButton.remove();
            li.appendChild(deleteButton);
        });

        // Ajouter le bouton de suppression
        li.appendChild(deleteButton);

        // Ajouter le bouton de basculement
        li.appendChild(toggleButton);

        return li;
    }

    // Fonction pour ajouter une tâche à la liste des tâches à faire
    function addTask(task) {
        const li = createTaskElement(task);
        todoList.appendChild(li);
    }

    // Fonction pour gérer la soumission du formulaire
    todoForm.addEventListener("submit", function(event) {
        // Empêcher le rechargement de la page
        event.preventDefault();

        // Ajouter la tâche à la liste des tâches à faire
        const task = taskInput.value;
        addTask(task);

        // Réinitialiser le champ de saisie de tâche
        taskInput.value = "";
    });
});
