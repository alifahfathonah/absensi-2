function verifData(id,base_url,nama){
    document.getElementById('id_users').value = id;
    document.getElementById('nama').value = nama;
    document.getElementById('title_modal').innerHTML = "Verifikasi Data Pegawai"
}

function deleteData(id){
    document.getElementById('btn_delete').href = "http://localhost/absensi/pegawai/delete_pegawai/" + id;
}