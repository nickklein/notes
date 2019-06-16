<template>
    <div class="modal fade show" tabindex="-1" role="dialog" v-if="showModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{title}}</h5>
            <button type="button" class="close" @click="$emit('close')" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p><slot></slot></p>
            
            <div class="form" v-if="enableModalInput">
                <div v-for="(item, index) in inputs" :key="index">
                    <div class="form-group" v-if="item.type != 'checkbox'">
                            <label>{{item.name}}</label>
                            <input id="email" :type="item.type" :placeholder="item.placeholder" class="form-control" :name="item.name" :value="item.value" v-model="getValue[index]">

                            <span v-if="errors.hasErrors" class="invalid-feedback block" role="alert">
                                <span>{{errors.errorText[index]}}</span>
                            </span>
                    </div>

                    <div class="form-check" v-if="item.type == 'checkbox'">
                        <input class="form-check-input" type="checkbox" :id="item.name" :checked="item.value" v-model="getValue">
                        <label class="form-check-label" :for="item.name">
                            {{item.name}}
                        </label>
                        <span v-if="errors.hasErrors" class="invalid-feedback block" role="alert">
                            <span>{{errors.errorText[index]}}</span>
                        </span>
                    </div>
                </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="submitForm">{{label}}</button>
            <button type="button" class="btn btn-secondary" @click="$emit('close')">Close</button>
        </div>
        </div>
    </div>
    </div>
</template>

<script>
    export default {
        name: 'static-modal',
        props: ['action', 'title', 'label', 'input', 'inputs'],
        data() {
            return {
                showModal: true,
                enableModalInput: false,
                modalInput: '',
                getValue: [],
                errors: {
                    hasErrors: false,
                    errorText: []
                }
            }
        },
        methods: {
            submitForm() {
                var self = this;
                this.inputs.forEach(function(element,index) {
                    element.value = self.getValue[index];
                });
                this.$http.post('/settings/account/destroy', {fields: this.inputs,_token: window.Laravel['csrfToken']})
                .then(function(response) {
                    console.log(response.data.error);
                    if (response.data.error.length > 0) {
                        this.errors.hasErrors = true;
                        response.data.error.forEach(function(row,index) {
                            self.errors.errorText[row.field] = row.message;
                        });
                    }
                });

            }
        },
        created: function() {
            this.enableModalInput = this.input;
        }

    }
</script>
