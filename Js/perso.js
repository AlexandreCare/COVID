function getId(id){
    document.getElementById(pText).style.content = id;
    document.getElementById(pText).value = id;
}

function GoToBattle(){
    value = document.getElementById("pText").value;

    if((document.getElementById("pText").value) == null){
        console.log('indiquez un nom');
    }
    else{
        console.log(document.getElementById("pText").value);
    }
}
