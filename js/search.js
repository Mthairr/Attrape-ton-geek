document.addEventListener("DOMContentLoaded", function() {
    const formSearch = document.getElementById("form-search");

    formSearch.addEventListener("submit", function(event) {
        event.preventDefault(); 


        const name = document.getElementById("name").value;
        const age = document.getElementById("age").value;
        const sexualindentity = document.getElementById("sexualindentity").value;


        const formData = new FormData();
        formData.append("name", name);
        formData.append("age", age);
        formData.append("sexualindentity", sexualindentity);

 
        fetch("page4.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
  
            console.log(data);

        })
        .catch(error => {
            console.error("Erreur lors de la recherche:", error);
        });
    });
});