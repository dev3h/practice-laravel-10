<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">I'm an example component.</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import pusher from "../bootstrap";
export default {
    mounted() {
        console.log("Component mounted.");
    },
    created() {
        //  window.Echo.channel("public").listen("user.notification", (e) => {
        //     console.log("e", e);
        // });
        var channel = pusher.subscribe("public");
        channel.bind("user.notification", function (data) {
            console.log("data", data);
        });
        console.log("created");
    },
};
</script>
