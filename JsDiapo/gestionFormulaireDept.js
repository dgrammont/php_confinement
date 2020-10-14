function afficherNomDepartement(event){
    //ne pas evoyer les doonnées du formulaire (sinon il y aura un changement de page
    event.preventDefault();
    //recupérer le contenu du champ numeroDept
    var numDept = $('#numeroDept').val(); //72
    $.ajax({
        url: 'controleur.php',
        data:
        {
            'commande': 'nomDeptFromNum',
            'numeroDepartement': numDept
        },      
        dataType: 'json',
        type: 'GET',    
        success: 
                function (donnees, status, xhr)     
        {
                //mettre le texte de la réponse ajax dans le champs div auant pour id nomDept
                $("#nomDept").text(donnees);
            
        },
        error: 
                function (xhr, status, error) 
        {
                    console.log("param : "+JSON.stringify(xhr));
                    console.log("status : "+status);
                    console.log("error : "+error);
        }
    });
}
$(document).ready(function () {
    //associer l'envois du formulaire a la fonction afficherNomDepartement
    $("#formNumDept").submit(afficherNomDepartement);
})