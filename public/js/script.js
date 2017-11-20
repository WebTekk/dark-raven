/**
 * Base url
 *
 * @returns {*|jQuery}
 */
function baseurl() {
    return $('head base').attr('href');
}

/**
 * Show loader element.
 */
function showLoader() {
    $("#loader").show();
}

/**
 * Hide loader element.
 */
function hideLoader() {
    $("#loader").hide();
}
