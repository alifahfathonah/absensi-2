function detail_pegawai(nama,no_pegawai,email,nama_jabatan,no_telp,device_id,foto,base_url){
    document.getElementById("nama").innerHTML = ": " +nama;
    document.getElementById("no_pegawai").innerHTML = ": "+no_pegawai;
    document.getElementById("email").innerHTML = ": "+email;
    document.getElementById("jabatan").innerHTML = ": "+nama_jabatan;
    document.getElementById("no_telp").innerHTML = ": "+no_telp;
    document.getElementById("device_id").innerHTML = ": "+device_id;
    document.getElementById("foto").src = base_url +"assets/image_profile/"+foto;
    
}

function confirmIzin(url){
    document.getElementById("confirm_link").href = url;
}