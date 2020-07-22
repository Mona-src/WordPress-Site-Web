(function () {
    const deleteButton = document.querySelectorAll(".c5.c-button a");

    deleteButton.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault()
            var confirm = window.confirm("Voulez-vous vraiment supprimer cet utilisateur ?");
            if (confirm == true) {
                window.location.href = e.target.href;
            }
        })
    });
})();