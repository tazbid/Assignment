/**
 *@name btnLoadStart
 *@description set loading animation in button
 *@parameter button id
 *@return  
 */
function btnLoadStart(id) {
    var loadText = $("#" + id).attr('data-loading-text');
    //console.log(loadText);
    $("#" + id + " span").html(loadText);
    $("#" + id).prop('disabled', true);
}

/**
 *@name btnLoadEnd
 *@description end loading animation in button
 *@parameter button id
 *@return  
 */
function btnLoadEnd(id) {
    var loadText = $("#" + id).attr('data-normal-text');
    //console.log(loadText);
    $("#" + id + " span").text(loadText);
    $("#" + id).prop('disabled', false);
}

/**
*@name imageValidateCLient
*@description validate image input
*@parameter input instance event,jquery validation
*@return  
*/
function imageValidateCLient(data, jquery_validation = false) {

    var id = $(data).attr('id');

    var fileExtension = ['jpeg', 'jpg', 'png', 'gif'];
    if ($.inArray($(data).val().split('.').pop().toLowerCase(),
        fileExtension) == -1) {
        // alert("Only '.jpeg','.jpg', '.png', '.gif' formats are allowed.");
        //alertify.warning("Only '.jpeg','.jpg', '.png', '.gif' formats are allowed.");
        toastr.error(
            "Only jpeg , jpg , png , gif formats are allowed.",
            'Error!', {
            timeOut: 8000,
            closeButton: true,
            progressBar: true,
            positionClass: "toast-bottom-right",
        });

        $("#" + id).val('');
    }


    //jquery validation
    if (jquery_validation === true) {
        $("#" + id).valid();
    }
}

/**
*@name imageValidateAndPreview
*@description validate image input & populate img tag
*@parameter input instance event, preview element id,jquery validation
*@return  
*/
function imageValidateAndPreview(data, preview_id, jquery_validation = false) {

    var id = $(data).attr('id');
    if (data.files && data.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {

            $('#' + preview_id).attr('src', e.target.result);
            $("#" + preview_id).show();
        };
        reader.readAsDataURL(data.files[0]);
    }

    var fileExtension = ['jpeg', 'jpg', 'png', 'gif'];
    if ($.inArray($(data).val().split('.').pop().toLowerCase(),
        fileExtension) == -1) {
        // alert("Only '.jpeg','.jpg', '.png', '.gif' formats are allowed.");
        //alertify.warning("Only '.jpeg','.jpg', '.png', '.gif' formats are allowed.");
        toastr.error(
            "Only jpeg , jpg , png , gif formats are allowed.",
            'Error!', {
            timeOut: 8000,
            closeButton: true,
            progressBar: true,
            positionClass: "toast-bottom-right",
        });

        $("#" + id).val('');
        $('#' + preview_id).attr('src', '');
        $('#' + preview_id).hide();
    }

    //jquery validation
    if (jquery_validation === true) {
        $("#" + id).valid();
    }


}


/**
 *@name reload
 *@description reload current page after a certain time
 *@parameter timout
 *@return  reload the page
 */
function reload(timeout) {
    setTimeout(() => {
        location.reload(true);
    }, timeout);
}


/**
 *@name redirect
 *@description redirect to another url after a certain time
 *@parameter url,timout
 *@return  redirected page
 */
function redirect(url, timeout) {
    setTimeout(() => {
        window.location.href = url;
    }, timeout);
}


/**
 *@name refreshDatatable
 *@description refresh data table
 *@parameter table id
 *@return refreshed datatable
 */
function refreshDatatable(id) {

    $("#" + id).DataTable().ajax.reload();
}

/**
 *@name showElement
 *@description show a hidden element
 *@parameter element id
 *@return 
 */
function showElement(id) {
    $("#" + id).show();
}


/**
 *@name goToElement
 *@description go to a targeted element
 *@parameter element id
 *@return 
 */
function goToElement(id) {
    $(window).scrollTop($('#' + id).offset().top);
}


/**
 *@name loadElement
 *@description load content of a targeted element
 *@parameter element id
 *@return 
 */
function loadElement(id) {
    $("#" + id).load(location.href + " #" + id);
}

/**
 *@name loginAlert
 *@description show a login/register alert to user
 *@parameter 
 *@return toastr alert
 */
function loginAlert() {

    toastr.info(
        "Please Login Or Register To Mark Your Monitor",
        'Info!', {
        timeOut: 8000,
        closeButton: true,
        progressBar: true,
        positionClass: "toast-top-center",
    });
}