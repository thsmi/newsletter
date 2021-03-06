<div id="tplAttachmentUpload">
  
  <form class="attachments-image-input-form">
    <p>
      Select the files which should be attached to the newsletter.
    </p>
    <div class="attachments-upload-progress" style="display:none">
 <div class="progress">
  <div class="progress-bar progress-bar-striped active" role="progressbar"
  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:100%">
    Uploading file, please wait...
  </div>
</div>      
    </div>

    <div class="input-group attachments-upload-input">
      <input class="attachments-image-input form-control" type="file" name="files" multiple="multiple" placeholder="Select file">
      <span class="input-group-btn">
          <button class="btn btn-default attachments-upload" type="button">Attach</button>
      </span>
    </div>
    <hr />
  </form>

</div>

<div id="tplAttachments">
  <div class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Attachments</h4>
        </div>
        <div class="modal-body">
          <div class="attachments-list">
            <div class="panel panel-default">
              <table class="table">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody class="attachments-list-item">
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="tplAttachmentItemAction">
  <a class="btn btn-default att-item-delete" role="button">Delete</a>
</div>

<div id="tplAttachmentItem">
  <table>
    <tbody>
      <tr>
        <td><a class="att-item-name">Name</a></td>
        <td class="att-item-action" style="text-align: right">&nbsp;</td>
</tr>
</tbody>
</table>
</div>