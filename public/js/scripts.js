function initReplaceContent(url){
$('#id_of_button').click(function(){
       var id = 1;
        getAjaxContent(id,url);
        $('#modal1').modal();
    }); 
}

function getAjaxContent(id,url){
         $.ajax({
		url: url + '/' + id,
		data: '',
		dataType: 'html',
		tryCount:0,//current retry count
		retryLimit:3,//number of retries on fail
		timeout: 2000,//time before retry on fail
		success: function(returnedData) {
			$('#content-replaceable').html(returnedData);//put the returned html into the div
		},
		error: function(xhr, textStatus, errorThrown) {
			 if (textStatus == 'timeout') {//if error is 'timeout'
				this.tryCount++;
				if (this.tryCount < this.retryLimit) {
					$.ajax(this);//try again
					return;
				}
			}//try 3 times to get a response from server
		}
	});
);