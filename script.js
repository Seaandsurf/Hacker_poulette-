
function verifierAll(value , error){
    if (value.length < 2 || value.length > 255) {
        error.innerHTML = "La chaîne doit contenir entre 2 et 255 caractères.";
        error.style.color = "red";
        return false;
    } else {
        error.innerHTML = "";
        return true;
    }
}

function verifierMail(value, error) {
    if (!value.includes('@') || value.length < 2 || value.length > 255) {
        error.innerHTML = "L'adresse e-mail doit contenir au moins un '@' et avoir une longueur entre 2 et 255 caractères.";
        error.style.color = "red";
        return false;
    } else {
        error.innerHTML = "";
        return true;
    }
}

function verifierDescription (value , error){
    if (value.length < 2 || value.length > 1000) {
        error.innerHTML = "La chaîne doit contenir entre 2 et 1000 caractères.";
        error.style.color = "red";
        return false;
    } else {
        error.innerHTML = "";
        return true;
    }
}

function verifierFile(value,error) {
    let file = value.files[0];
    if(file){
        if (file.size > 2 * 1024 * 1024) {
            error.innerHTML = "La taille du fichier ne doit pas dépasser 2 Mo.";
            error.style.color = "red";
            return false;
        }
        else{
            return true ;
        }
    }else{
        return true;
    }
}



function verifierInput(event) {
   
    //Confirmation du Name
    let inputName = document.getElementById('name').value;
    let errorName = document.getElementById("errorName");
    let value1 = verifierAll(inputName, errorName);

    //Confirmation du Firstname
    let inputFirstname = document.getElementById('firstname').value;
    let errorFirstname  = document.getElementById("errorFirstname");
    let value2 = verifierAll(inputFirstname, errorFirstname);

    //Confirmation du Mail
    let inputMail = document.getElementById('mail').value;
    let errorMail = document.getElementById("errorMail");
    let value3 = verifierMail(inputMail, errorMail);

    
    //Confirmation du File
    let inputFile = document.getElementById('file');
    let errorFile = document.getElementById('errorFile');
    let value4 = verifierFile(inputFile,errorFile);


    //Confirmation du Description
    let inputDescription = document.getElementById('description').value;
    let errorDescription = document.getElementById("errorDescription");
    let value5 = verifierDescription(inputDescription, errorDescription);

    if(value1 == true && value2 == true && value3 == true && value4 == true && value5 == true ){
        
    }
    else{
         event.preventDefault();
    }   
}



