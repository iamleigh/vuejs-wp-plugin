<template>
	<Fragment>
		<div role="tablist">
			<button role="tab">Table</button>
			<button role="tab">Graph</button>
			<button role="tab">Settings</button>
		</div>
		<div>Table content</div>
		<div>Graph content</div>
		<div>Settings content</div>
	</Fragment>
</template>

<script>
import { Fragment } from 'vue-fragment';

export default {
    name: 'App',
	components: {
		Fragment
	}
}
</script>
