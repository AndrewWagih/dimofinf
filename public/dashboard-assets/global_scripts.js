let arrows;

if (KTUtil.isRTL()) {
    arrows = {
        leftArrow: '<i class="la la-angle-right"></i>',
        rightArrow: '<i class="la la-angle-left"></i>'
    }
} else {
    arrows = {
        leftArrow: '<i class="la la-angle-left"></i>',
        rightArrow: '<i class="la la-angle-right"></i>'
    }
}


let removeValidationMessages = function() {
    /** Remove All Validation Messages **/

    let errorElements = $('.invalid-feedback');

    errorElements.html('').css('display','none');

    $('form .form-control').removeClass('is-invalid is-valid') // remove validation borders

}

let displayValidationMessages = function(errors, trailing = "") {

    removeValidationMessages();

    $('#submitted-form .form-control').addClass('is-valid') // remove validation borders

    /** Display All Validation Messages **/
    $.each(errors, function(elementId, errorMessage) {

        elementId = elementId.replaceAll('.','_');

        let errorInput   = $("#" + elementId + '_inp'+ trailing );
        let errorElement = $("#" + elementId + trailing);

        if (errorElement != null)
            errorElement.html(errorMessage).css('display','block')
        if (errorInput   != null)
            errorInput.addClass('is-invalid')

    });

    /** scroll to the first error element **/
    let firstErrorElementId = Object.keys(errors)[0].replaceAll('.','_');

    let firstErrorElement   = document.getElementById(firstErrorElementId + trailing);

    firstErrorElement.scrollIntoView({ behavior: 'smooth', block: 'center' });


}


let showHidePass = function( fieldId , showPwIcon )
{
    let passField = $("#" + fieldId);

    if ( passField.attr("type") === "password")
    {
        passField.attr("type","text");
        showPwIcon.children().eq(0).removeClass("fa-eye").addClass("fa-eye-slash");
    }
    else
    {
        passField.attr("type","password");
        showPwIcon.children().eq(0).removeClass("fa-eye-slash").addClass("fa-eye");
    }

}

let blockUi = function(id) {
    /** block container ui **/
    KTApp.block(id, {
        overlayColor: '#000000',
        state: 'danger',
        message: 'Please wait ...',
    });
}

let unBlockUi = function(id, timer = 0) {
    /** unblock container ui **/
    setTimeout(function() {
        KTApp.unblock(id);
    }, timer);
}

/** Begin :: System Alerts  **/

let deleteAlert = function(elementName = "item" , ) {
    return Swal.fire({
        text: `${'Are you sure you want to delete this  ' + elementName + ' ? All data related to this ' + elementName + ' will be deleted' }`,
        icon: "warning",
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: 'Yes, Delete !',
        cancelButtonText: 'No, Cancel',
        customClass: {
            confirmButton: "btn fw-bold btn-danger",
            cancelButton: "btn fw-bold btn-active-light-primary"
        }
    })
}

let errorAlert = function(message = "something went wrong", time = 5000) {
    return Swal.fire({
        text: message,
        icon: "error",
        buttonsStyling: false,
        showConfirmButton: false,
        timer: time,
        customClass: {
            confirmButton: "btn fw-bold btn-primary",
        }
    });
}

let successAlert = function(message = "Operation done successfully" , timer = 2000) {

    return Swal.fire({
        text: message,
        icon: "success",
        buttonsStyling: false,
        showConfirmButton: false,
        timer: timer
    });

}

let inputAlert = function() {

    return Swal.fire({
        icon:'warning',
        title: 'write a comment',
        html: '<input id="swal-input1" class="form-control">',
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonColor:'#1E1E2D',
        cancelButtonColor:'#c61919',
        confirmButtonText: `<span> change </span>`,
        cancelButtonText: `<span> cancel </span>`,
        preConfirm: () => {
            return [
                document.getElementById('swal-input1').value,
            ]
        },
    });

}

let changeStatusAlert = function(type = "change") {

    if(type == 'date')
    {
        return Swal.fire({
            icon:'warning',
            title: 'Pick new date',
            html: '<input type="date" required id="swal-input1" class="form-control">',
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonColor:'#1E1E2D',
            cancelButtonColor:'#c61919',
            confirmButtonText: `<span> change </span>`,
            cancelButtonText: `<span> cancel </span>`,
            preConfirm: () => {
                return [
                    document.getElementById('swal-input1').value,
                ]
            },
        });
    }

    return Swal.fire({
        icon:'warning',
        title: 'change order status',
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonColor:'#1E1E2D',
        cancelButtonColor:'#c61919',
        confirmButtonText: `<span> change </span>`,
        cancelButtonText: `<span> cancel </span>`,

    });

}


let warningAlert        = function(title , message , time = 5000) {
    return swal.fire({
        title: title,
        text: message,
        icon: "warning",
        showConfirmButton: false,
        timer: time
    });
}

let unauthorizedAlert   = function() {
    return swal.fire({
        title: "Error !",
        text: "This action is unauthorized.",
        icon: "error",
        showConfirmButton: false,
        timer: 5000,
    });
}

let loadingAlert  = function(message = "Loading..." ) {

    return  Swal.fire({
        text: message,
        icon: "info",
        buttonsStyling: false,
        showConfirmButton: false,
        timer: 2000
    });

}

let getImagePath = function(directory,imageName) {

    return imagesBasePath + '/' + directory + '/' + imageName;
}

/** End :: System Alerts  **/

function toEnglishNumber(x) {
    return x.replace(/[\u0660-\u0669\u06f0-\u06f9]/g, c => c.charCodeAt(0) & 0xf);
}

/** Start :: Submit any form in dashboard function  **/
let submitForm = (form) => {

    $(`input[type="tel"]`).on('input',function(){
        $(this).val(toEnglishNumber($(this).val()));
    })
    $(`input[type="number"]`).on('input',function(){
        $(this).val(toEnglishNumber($(this).val()));
    })

    let formData  = new FormData( form );
    form = $(form);
    let submitBtn = form.find("[id*=submit-btn]");

    submitBtn.attr('disabled',true).attr("data-kt-indicator", "on");

    $.ajax({
        method:form.attr ('method'),
        url:form.attr('action'),
        data:formData,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        processData:false,
        contentType: false,
        cache: false,
        enctype: 'multipart/form-data',
        success:function (response) {
            removeValidationMessages();
            successAlert( response.message?response.message:form.data('success-message') ).then( () => window.location.replace( form.data('redirection-url') ) );
        },
        error:function (response) {

            removeValidationMessages();

            if (response.status === 422)
                displayValidationMessages(response.responseJSON.errors , form.data('trailing'));
            else if (response.status === 403)
                unauthorizedAlert();
            else
                errorAlert(response.responseJSON.message , { time: 5000 })
        },
        complete:function () {
            submitBtn.attr('disabled',false).removeAttr("data-kt-indicator")
        }
    });

}
/** End   :: Submit any form in dashboard function  **/




$(document).ready(function () {

    /** Start :: ajax request form  **/
    $('#submitted-form,.submitted-form,#role_form_update,#role_form_add').submit( function (event) {

        event.preventDefault();

        submitForm( this );

    })
    /** End   :: ajax request form  **/

    /** initialize datepicker inputs */
    $(".datepicker").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 2000,
        locale: {
            format: 'YYYY-MM-DD',
            cancelLabel: 'Clear',
            applyLabel: 'Apply',
        },
        maxYear: parseInt(moment().format("YYYY"),10)
    }).val('').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('').trigger('change');
    });

    /** customizing select2 message */

    $('select').select2({
        "language": {
        "noResults": function(){ return "No results found"; }
        },
        allowClear: true
    })



})



// document.onreadystatechange = function() {
//     if (document.readyState === 'complete') {
//         $('.filter-datatable-inp').on('change',function(){
//             $('.filter-datatable-inp').attr('disabled',true)
//             checks();
//         })
//         function checks(check=true){
//             if(check=true){
//                 if($(`#kt_datatable_processing`).is(":visible")){
//                     checks(check=true);

//                 }else{
//                     setTimeout(() => {
//                     $('.filter-datatable-inp').attr('disabled',false)
//                     }, 2000);
//                     return 0;
//                 }
//             }

//         }



//     }
// }


