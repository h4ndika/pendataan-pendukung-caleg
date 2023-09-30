<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Template Main JS File -->
<script src="{{ url('') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ url('') }}/assets/js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<!-- Vendor JS Files -->
@stack('script')

<script>
    $.ajax({
            type: "GET",
            url: "{{url('')}}/api/v1/auth/me",
            dataType: "json",
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer " + localStorage.getItem("access_token"));
            },
        }).fail(function(jqXHR, textStatus, errorThrown) {
            Toastify({
                text: "Session Telah Berakhir, Silahkan Login ulang",
                duration: 3000,
                close: true,
                backgroundColor: "#dc3545",
            }).showToast()
            localStorage.clear();
            setTimeout(() => {
                window.location = "{{url('')}}"
            }, 300);
        })

    var datauser = JSON.parse(localStorage.getItem("data"));
    for (let i = 0; i < $('.name-user').length; i++) {
        const name_user = $('.name-user').eq(i);
            name_user.html(datauser.name)
    }

    $(document).ready(function() {

        $('#formgantipassword').on('submit', function(e) {

            e.preventDefault();

            var datas = $("#formgantipassword").serialize();

            $.ajax({
                type: "POST",
                url: "{{ url('') }}/api/v1/auth/"+localStorage.getItem("role")+"/change-password",
                dataType: "json",
                beforeSend: function (xhr) {
                    xhr.setRequestHeader ("Authorization", "Bearer " + localStorage.getItem("access_token"));
                },
                data: datas
            }).done(function(data) {
                if (data.success == true) {
                    Toastify({
                        text: "Berhasil diganti",
                        duration: 3000,
                        close: true,
                        backgroundColor: "#198754",
                    }).showToast()
                } else {
                    Toastify({
                        text: "Gagal diganti",
                        duration: 3000,
                        close: true,
                        backgroundColor: "#dc3545",
                    }).showToast()
                }
                $('#gantipassword').modal('hide')
                document.getElementById("formgantipassword").reset();
            }).fail(function(jqXHR, textStatus, errorThrown) {
                if (jqXHR.status == '401') {
                    Toastify({
                        text: "Session Telah Berakhir, Silahkan Login ulang",
                        duration: 3000,
                        close: true,
                        backgroundColor: "#dc3545",
                    }).showToast()
                    $('#gantipassword').modal('hide')
                    document.getElementById("formgantipassword").reset();

                    localStorage.clear();
                    setTimeout(() => {
                        window.location = "{{url('')}}"
                    }, 300);
                } else {
                    var msg = jqXHR.responseJSON.message ?? "Data Salah, silahkan masukan dengan benar";
                    Toastify({
                        text: msg,
                        duration: 3000,
                        close: true,
                        backgroundColor: "#dc3545",
                    }).showToast()
                    $('#gantipassword').modal('hide')
                    document.getElementById("formgantipassword").reset();
                }

            })
        });

    });
</script>

</body>

</html>
