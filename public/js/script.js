/**
 * Base url
 *
 * @returns {*|jQuery}
 */
function baseurl() {
    return $("meta[name=xhr-baseurl]").attr("content");
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
