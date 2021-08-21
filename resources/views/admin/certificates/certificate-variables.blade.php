<!-- Variables Model -->
<div class="modal fade" id="variables_model">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Variables</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <br><small class="text-info"><b>Click on variable to copy</b></small>
                <table class="table table-bordered" id="variablesTable">
                    <thead>
                        <tr class="text-center">
                            
                        </tr>
                        <tr>
                            <th>Variable</th>
                            <th>Meaning</th>
                        </tr>
                    </thead>
                    <tbody style="font-size:12px">
                        <tr>
                            <td class="click-to-copy" title="copy" onclick="varCopyLink('{SITE_LOGO}')">{SITE_LOGO}</td>
                            <td> Site Logo. </td>
                        </tr>
                        <tr>
                            <td class="click-to-copy" title="copy" onclick="varCopyLink('{COURSE_TYPE}')">{COURSE_TYPE}</td>
                            <td> Type of the course. </td>
                        </tr>
                        <tr>
                            <td class="click-to-copy" title="copy" onclick="varCopyLink('{COURSE_DATE}')">{COURSE_DATE}</td>
                            <td> Start date of the course. </td>
                        </tr>
                        <tr>
                            <td class="click-to-copy" title="copy" onclick="varCopyLink('{COURSE_DAYS}')">{COURSE_DAYS}</td>
                            <td> Total days of the course. </td>
                        </tr>
                        <tr>
                            <td class="click-to-copy" title="copy" onclick="varCopyLink('{COURSE_NAME}')">{COURSE_NAME}</td>
                            <td> Name of the course. </td>
                        </tr>
                        <tr>
                            <td class="click-to-copy" title="copy" onclick="varCopyLink('{TRAINEE_NAME}')">{TRAINEE_NAME}</td>
                            <td> Name of the trainee. </td>
                        </tr>
                        <tr>
                            <td class="click-to-copy" title="copy" onclick="varCopyLink('{COURSE_ADDRESS}')">{COURSE_ADDRESS}</td>
                            <td> Course Address. </td>
                        </tr>
                        <tr>
                            <td class="click-to-copy" title="copy" onclick="varCopyLink('{CERTIFICATE_ISSUE_DATE}')">{CERTIFICATE_ISSUE_DATE}</td>
                            <td> Certificate Issue date. </td>
                        </tr>
                    </tbody>
                </table>
                <div id="var_copy_box"></div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function varCopyLink(text){
        var $temp = $("<input>");
        $("#var_copy_box").append($temp);
        $temp.val(text).select();
        document.execCommand("copy");
        $temp.remove();
        $('#variables_model').modal('hide');
        alert('copied!');
    }
</script>
