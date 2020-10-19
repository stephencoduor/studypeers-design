const tldPrepender = () => {
	const elements = $('#auth_endpoint,#token_endpoint');
	let url = $('#canvasURL').val() || 'canvasInstance.com/';
	url = url.replace(/\/$/,'')+"/";
	$.each(elements,(i,val)=>{
		$(val).text(url);
	});
};
const tld = () => {
    if ($('#schoolWebsite').length) {

        $('#schoolWebsite').blur((e) => {
            let link = $(e.currentTarget).val();
            let url = new URL(link);
            url = url.host.replace('/^www./', '');

			$('#emailDomain').val(url);
			
		});
		$('#canvasURL').blur(()=>{
			tldPrepender();
		})
    }

};




$(document).ready(function() {
	tld();
	
})
