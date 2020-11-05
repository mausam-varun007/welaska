(function () {
	'use strict';
	angular.module('socialShare',[]);

	angular
		.module('socialShare')
		.service('shareService', shareService)
		.directive('socialShare', socialShare);
	/** @ngInject **/
	function socialShare($location, shareService) {
		return {
			restrict: 'A',
			scope: {
				conf: '='
			},
			link: linkFunc
		};

		function linkFunc(scope, el) {
			scope.$watch('conf', function (newVal, oldVal) {
				if ((newVal !== '') && (newVal !== null) && (newVal !== undefined)) {
					if ((newVal.constructor === Object) && (Object.keys(newVal).length > 0)) {
						// Check if given provider is valid.
						if (newVal.hasOwnProperty('provider') && shareService.providers.includes(newVal.provider.toLowerCase())) {
							// Loop through providers configuration to check if there is a config for given provider
							for (let i = 0; i < shareService.config.length; i++) {
								// Match provider name and set conf in scope
								if (shareService.config[i].provider === newVal.provider.toLowerCase()) {
									if (shareService.config[i].hasOwnProperty('func')) {
										el.off('click');
										el.bind('click', function () {
											shareService.config[i].func(angular.copy(scope.conf));
										});
									}
									break;
								}
							}
						} else {
							el.remove();
						}
					}
				}
			}, true);
		}
	}
	function shareService(toastr) {
		let self = this;
		this.providers = [
			'facebook', 'twitter', 'linkedin', 'whatsapp', 'clipboard'
		];
		this.config = [
			{
				provider: 'facebook',
				conf: {
					'url':'',
					'title':'',
					'href':'',
					'quote':'',
					'hashtags':'',
					'text': '',
					'media': '',
					'mobile_iframe': '',
					'type': '',
					'via': '',
					'to': '',
					'from': '',
					'ref': '',
					'display': '',
					'source': '',
					'caption': '',
					'redirectUri': '',
					'trigger': 'click',
					'popupHeight': 600,
					'popupWidth': 500
				},
				func: shareOnFacebook
			},
			{
				provider: 'twitter',
				conf: {
					'url': '',
					'text': '',
					'via': '',
					'hashtags': '',
					'trigger': 'click',
					'popupHeight': 600,
					'popupWidth': 500
				},
				func: shareOnTwitter
			},
			{
				provider: 'linkedin',
				conf: {
					'url': '',
					'heading': '',
					'summary': '',
					'source': '',
					'trigger': 'click',
					'popupHeight': 600,
					'popupWidth': 500
				},
				func: shareOnLinkedin
			},
			{
				provider: 'whatsapp',
				conf: {
					'url': '',
					'text': ''
				},
				func: shareOnWhatsapp
			},
			{
				provider: 'clipboard',
				conf: {
					url: ''
				},
				func: copyOnClipboard
			}
		];

		function shareOnFacebook(params = {}) {
			//otherwise default to using sharer.php
			window.open(
				'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(params.url || window.location.href)
				, 'Facebook', 'toolbar=0,status=0,resizable=yes,width=500,height=600' +
				',top=' + (window.innerHeight - 600) / 2 + ',left=' + (window.innerWidth - 500) / 2);
		}

		function shareOnTwitter(params= {}) {
			let urlString = 'https://www.twitter.com/intent/tweet?';

			if (params.text !== '') {
				urlString += 'text=' + encodeURIComponent(params.text);
			}

			if (params.via !== '') {
				urlString += '&via=' + encodeURIComponent(params.via);
			}

			if (params.hashtags !== '') {
				let tempHashtags = params.hashtags.split(',').map(function (str) {
					return makeHashtag(str);
				}).join(',');
				urlString += '&hashtags=' + encodeURIComponent(tempHashtags);
			}

			//default to the current page if a URL isn't specified
			urlString += '&url=' + encodeURIComponent(params.url || window.location.href);

			window.open(
				urlString,
				'Twitter', 'toolbar=0,status=0,resizable=yes,width=500,height=600'+
				',top=' + (window.innerHeight - 600) / 2 + ',left=' + (window.innerWidth - 500) / 2);
		}

		function shareOnLinkedin(params = {}) {
			let urlString = 'https://www.linkedin.com/shareArticle?mini=true';

			urlString += '&url=' + encodeURIComponent(params.url || window.location.href);

			if (params.title) {
				urlString += '&title=' + encodeURIComponent(params.heading);
			}

			if (params.summary) {
				urlString += '&summary=' + encodeURIComponent(params.summary);
			}

			if (params.source) {
				urlString += '&source=' + encodeURIComponent(params.source);
			}
			window.open(
				urlString,
				'Linkedin', 'toolbar=0,status=0,resizable=yes,width=500,height=600' +
				',top=' + (window.innerHeight - 600) / 2 + ',left=' + (window.innerWidth - 500) / 2);
		}

		function shareOnWhatsapp() {
			window.open('whatsapp://send?text=' + encodeURIComponent('Test Message') + '%0A' + encodeURIComponent(window.location.href), '_top');
		}

		function copyOnClipboard(params = {}) {
			let tempInput = document.createElement("input");
			document.body.appendChild(tempInput);
			tempInput.value = params.url;
			tempInput.select();
			tempInput.setSelectionRange(0, 99999);
			document.execCommand("copy");
			document.body.removeChild(tempInput);
			toastr.info('Url copied to clipboard');
		}

		function makeHashtag(str) {
			let wordArray = str.replace(/[-_]/g, ' ').split(' ').filter(char => char !== "");
			let result = "";

			if (wordArray.length === 0) {
				return false;
			}

			result = result + wordArray.map(word => {
				return word.charAt(0).toUpperCase() + word.slice(1);
			}).join('');

			if(result.length > 140) {
				return false;
			} else{
				return result;
			}
		}
	}
	socialShare.$inject = ['$location', 'shareService'];
	shareService.$inject = ['toastr'];

})();

