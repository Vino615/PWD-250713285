function fn_ValForm(){
    var choice = " ";
    var sInfo = "";
    var sMsg = "";
    var validEmail = /^[a-z0-9][a-z0-9_\.-]{0,}[a-z0-9]@[a-z0-9][a-z0-9_\.-]{0,}[a-z0-9][\.][a-z0-9]{2,4}$/;
    var snama = document.getElementById("nama").value;
    var semail = document.getElementById("email").value;
    var smember = document.getElementById("kategori").value;
    var sumur = document.getElementById("umur").value;

    if(snama == " "){
        sMsg += "\n*Nama Belum diisi";
    }

    if(semail == " "){
        sMsg += "\n*Email belum diisi";
    }else if(!validEmail.test(semail)){
        sMsg += "Format email tidak valid";
    }

    if(smember == ""){
        sMsg += "\n*Member belom dipilih";
    }

    if(sMsg != ""){
        alert("Peringatan:\n" + sMsg);
        return false;
    }

if(sumur == " "){
    sMsg += "Umur belum diisi";
}else if(isNaN(sumur)){
    sMsg += "Umur harus berupa angka";
}else{
    var umur = parseInt(sumur);
    if(umur > 65){
        sMsg += "Umur harus berada di antara 17 sampai 65";
    }else if(umur >= 17){
        if(umur > 25){
            sInfo = " PAKET UMUM";
        }else{
            sInfo = " Paket Pelajar";
        }

    }else{
        sMsg += "Umur harus berada di antara 17 sampai 65";
    }
    
}

switch(smember){
    case "S":
        choice = "Silver";
        break;
    case "G":
        choice = "Gold";
        break;
    case "P":
        choice = "Platinum";
        break;
    
}

alert("Terima kasih " + snama + " ! Anda terdaftar di paket " + choice + " " + sInfo);
return true;

}


