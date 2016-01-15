var options = {
    /**
     * URL which handles the data
     */
    uploadUrl: '/inline-attach',

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

    /**
     * Will be inserted on a drop or paste event
     */
    progressText: '![Uploading file...]()',

    /**
     * When a file has successfully been uploaded the last inserted text
     * will be replaced by the urlText, the {filename} tag will be replaced
     * by the filename that has been returned by the server
     */
    urlText: "![file]({filename})",

    /**
     * Error message for default error handler
     */
    errorText: "Error uploading file",

    /**
     * Extra parameters which will be send as POST data when sending a file
     */
    extraParams: {},

    /**
     * When a file is received by drag-drop or paste
     *
     * @param {Blob} file
     */
    onReceivedFile: function(file) {},

    /**
     * When a file has succesfully been uploaded
     *
     * @param {Object} json JSON data returned from the server
     */
    onUploadedFile: function(json) {},

    /**
     * Custom error handler. Runs after removing the placeholder text and before the alert().
     * Return false from this function to prevent the alert dialog.
     *
     * @return {Boolean} when false is returned it will prevent default error behavior
     */
    customErrorHandler: function() { return true; },

    /**
     * Custom upload handler, must return false to prevent default handler.
     * Can be used to send file via custom transport(like socket.io)
     *
     * @param {Blob} file
     * @return {Boolean} when false is returned it will prevent default upload behavior
     */
    customUploadHandler: function(file) { return true; },

    /**
     * Data processor after upload a file
     *
     * @param {Object} data JSON data returned from the server
     * @return {Object} modified object
     */
    dataProcessor: function(data) { return data; }
};