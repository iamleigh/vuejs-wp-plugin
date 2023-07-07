<template>
	<div
		role="alert"
		class="leighton-quito-notice"
		:class="setNoticeClass">
		<slot />
	</div>
</template>

<script>
export default {
	name: 'UINotice',
	props: {
		mode: {
			Type: String,
			default: null
		}
	},
	computed: {
		setNoticeClass: function () {
			let setClass = '';

			switch (this.mode) {
				case 'loading':
				case 'error':
					setClass = 'leighton-quito-notice--' + this.mode;
					break;

				default:
					// do nothing
					break;
			}

			return setClass;
		}
	}
}
</script>
