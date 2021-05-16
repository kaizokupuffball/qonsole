<template>
    <div class="qonsole-container">
        <div class="heading">
            <h2>Qonsole Demo</h2>
            <console user="root" host="qonsole"></console>
        </div>
    </div>
</template>

<script>
import console from './console';
export default {
    components: {
        console
    }
}
</script>