/**
 * Enable Bs Tooltip
 * @type {*[]}
 */
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-info="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})

/**
 * Modal Delete WBS
 */

let wbsRemoveFeedback = document.getElementById('wbsRemoveFeedback')
wbsRemoveFeedback.addEventListener('show.bs.modal', function (event) {
  let button = event.relatedTarget
  let recipient = button.getAttribute('data-bs-feedback-id')
  // let modalTitle = wbsRemoveFeedback.querySelector('.modal-title')
  let FeedbackInputId = wbsRemoveFeedback.querySelector('.modal-footer input')

  //modalTitle.textContent = 'New message to ' + recipient
  //FeedbackInputId.value = recipient

    $('#remove_id_feedback').val(recipient);

})
