<script type="text/javascript">
    $(document).ready(function () {
        $('#registrationForm').submit(function () {
            // Validasi Username
            var username = $('#usrname').val();
            if (username.length < 8) {
                alert('Username harus minimal 8 karakter.');
                return false;
            }

            // Validasi Password
            var password = $('#password').val();
            if (!/\d/.test(password) || !/[a-zA-Z]/.test(password)) {
                alert('Password harus mengandung setidaknya satu karakter angka dan satu karakter huruf.');
                return false;
            }

            // Validasi Phone Number
            var phoneNumber = $('#Contact_No').val();
            if (phoneNumber.length !== 12) {
                alert('Phone number harus terdiri dari 12 angka.');
                return false;
            }

            // Validasi Address
            var address = $('#address').val();
            if (address.split(' ').length < 2) {
                alert('Address harus minimal terdiri dari 2 kata.');
                return false;
            }

            return true;
        });
    });
</script>

