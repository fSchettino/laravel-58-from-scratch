<template>
    <!--Each component must have an external div acting as a wrapper-->
    <div>
        <!-- Adding : before an attribute convert the html attribute (type) in a vue binded property, just as label property-->
        <!--props naming does not accept kebab case or camel case (btn-type, btnType)-->
        <button :type="btn_type" class="custom-button-class" v-text="btnProperties.label"></button>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Custom button component mounted.');

            // Fetch data from backend using axios HTTP client
            axios.post('api/vue', {})
                .then(response => {
                    this.btnProperties = response.data;
            });
        },

        data: function () {
            return {
                btnProperties: null
            }
        },

        name: "custom-button-v2",

        props: [
            'label',
            'btn_type'
        ]
    }
</script>

<style scoped>
    .custom-button-class {
        background-color: #2fa360;
        color: white;
        padding: 10px 20px;
        border-radius: 4px;
        border: 0px;
    }
</style>
