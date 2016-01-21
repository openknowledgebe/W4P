var options = {
    /**
     * Name of the POST field where the file will be sent.
     * Defaults to 'file'.
     */
    uploadFieldName: 'file',

    /**
     * Name of the field from the response where the file can be downloaded.
     * Defaults to 'filename'
     */
    downloadFieldName: 'file',

    // List of allowed MIME types
    allowedTypes: [
        'image/jpeg',
        'image/png',
        'image/jpg',
        'image/gif'
    ],

    onFileUploadResponse: function(XMLHttpRequest) {
        var status = $.parseJSON(XMLHttpRequest.response);
        if (typeof status.error !== 'undefined') {
            alert(status.error);
        }
    }
};