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
	computed: {
		setNoticeClass: function () {
			let setClass = '';

			switch (this.type) {
				case 'loading':
				case 'error':
					setClass = 'leighton-quito-notice--' + this.type;
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
