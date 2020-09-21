$(document).ready(function(){
    $(document).on('click' , '.btn-delete' ,function(){
        if(confirm("Are you sure want to delete the movie?")) {
            let id = this.id;
            $.ajax({
                url: 'delete.php',
                type: 'POST',
                dataType: 'JSON',
                data: {"id":id},
                success:function(status){
                    if (status) {
                        $.notify({
                            message: "Movie was deleted."
                        },{
                            type: 'success',
                            delay: 4000,
                        });
                        $('div#' + id + '.card').remove();
                    } else {
                        $.notify({
                            message: "Something went wrong"
                        },{
                            type: 'danger',
                            delay: 4000,
                        });
                    }

                }
            });
        }
    });

    $('#sessions_start').on('change',function () {
        compareSessionsDates();
    });

    $('#sessions_end').on('change',function () {
        compareSessionsDates();
    });

    function compareSessionsDates() {
        let startDate = $('#sessions_start').val();
        let endDate = $('#sessions_end').val();

        if (startDate && endDate && startDate > endDate) {
            $('#sessions_start, #sessions_end').addClass('border border-danger');
            $('#add-btn').addClass('disabled-btn').prop("disabled", true);
            $.notify({
                message: "Start date cannot be less than the end date"
            },{
                type: 'danger',
                delay: 4000,
            });
        } else {
            $('#sessions_start, #sessions_end').removeClass('border border-danger');
            $('#add-btn').removeClass('disabled-btn').prop("disabled", false);
        }
    }

    let movieId = '';
    let sessionTime = '';
    let sessionDate = '';

    $(document).on('click' , '.session-time' ,function() {
        movieId = $('#sessions_date').attr("data-movie-id");
        sessionTime = $(this).attr("data-time");
        sessionDate = $('#sessions_date').val();
        let cinemaHallTable = $('table.cinema-places-table');
        if (!sessionDate) {
            $('#sessions_date').addClass('border border-danger');
            $.notify({
                message: "Please select the session date"
            },{
                type: 'danger',
                delay: 4000,
            });
        } else {
            $('#sessions_date').removeClass('border border-danger');
            $.ajax({
                url: 'load-cinema-hall.php',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    movie_id : movieId,
                    session_time : sessionTime,
                    session_date : sessionDate,
                },
                success:function(data) {
                    if (data.length) {
                        $.each(data, function (key, reservedPlace) {
                            cinemaHallTable.find('td').each (function() {
                                if ($(this).attr('data-place') == reservedPlace.place) {
                                    $(this).addClass('reserved-place');
                                    $('td.reserved-place').prop("disabled", true);
                                } else {
                                    $(this).addClass('free-place');
                                }
                            });
                        });
                    } else {
                        cinemaHallTable.find('td').each (function() {
                            $(this).removeClass('reserved-place');
                            $(this).addClass('free-place');
                        });
                    }
                    $('table.inactive-hall tbody td').prop('disabled', false);
                    cinemaHallTable.removeClass('inactive-hall');
                }
            });
        }
    });

    $('table.inactive-hall tbody td').prop("disabled", true);

    $(document).on('click' , 'table.cinema-places-table tbody td' ,function() {
        let place = $(this).attr('data-place');

        $('#reservePlace #movieId').val(movieId);
        $('#reservePlace #sessionDate').val(sessionDate);
        $('#reservePlace #sessionTime').val(sessionTime);
        $('#reservePlace #place').val(place);

        $("#reserve-place-modal").modal('show');

    });

    $(document).on('click' , '#reserve-place-btn' ,function(){
        let emailInput = $("#reservePlace #email");
        let phoneInput = $("#reservePlace #phone");
        let placeInput = $("#reservePlace #place");
        let email = emailInput.val();
        let phone = phoneInput.val();
        let place = placeInput.val();

        emailInput.removeClass('border border-danger');
        phoneInput.removeClass('border border-danger');

        if (email.length && phone.length && isEmail(email) && isPhoneNumber(phone)) {
            $.ajax({
                url: 'reserve-place.php',
                type: 'POST',
                dataType: 'JSON',
                data: $("#reservePlace").serialize(),
                success:function(response){
                    $("#reserve-place-modal").modal('hide');

                    if (response) {
                        let td = $("table.cinema-places-table td[data-place='"+place+"']");
                        td.removeClass('free-place').addClass('reserved-place').prop("disabled", true);
                        $.notify({
                            message: "Place successfully reserved"
                        },{
                            type: 'success',
                            delay: 4000,
                        });
                    } else {
                        $.notify({
                            message: "Something went wrong"
                        },{
                            type: 'danger',
                            delay: 4000,
                        });
                    }
                }
            });
        } else {
            if (!email.length && !phone.length) {
                emailInput.addClass('border border-danger');
                phoneInput.addClass('border border-danger');
                $.notify({
                    message: "Please enter email address and phone number"
                },{
                    type: 'danger',
                    delay: 4000,
                });
            }
            if (email.length && !phone.length) {
                phoneInput.addClass('border border-danger');
                $.notify({
                    message: "Phone number is required"
                },{
                    type: 'danger',
                    delay: 4000,
                });
            }
            if (!email.length && phone.length) {
                emailInput.addClass('border border-danger');
                $.notify({
                    message: "Phone number is required"
                },{
                    type: 'danger',
                    delay: 4000,
                });
            }
            if (email.length && !isEmail(email)) {
                emailInput.addClass('border border-danger');
                $.notify({
                    message: "Please enter correct email address"
                },{
                    type: 'danger',
                    delay: 4000,
                });
            }
            if (phone.length && !isPhoneNumber(phone)) {
                phoneInput.addClass('border border-danger');
                $.notify({
                    message: "Please enter correct phone number"
                },{
                    type: 'danger',
                    delay: 4000,
                });
            }
        }
    });

    function isEmail(email) {
        let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    function isPhoneNumber(phone) {
        let regex = /^[+]*[(]{0,1}[0-9]{1,3}[)]{0,1}[-\s\./0-9]*$/g;
        return regex.test(phone);
    }
});

