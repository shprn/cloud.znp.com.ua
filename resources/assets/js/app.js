/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/*
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
    data: {
        disk: '',
        folder: '',
        activeFileId: -1,
        activeFileElem: null,
        activeDirectoryId: -1,
        propertiesActiveFile: []
    },

    created: function () {
        path = window.location.pathname;
        arr = path.split('/storage/');
        this.disk = arr[0];
        this.folder = arr[1];
    },

    methods: {
        setProperty(arr, name, value) {
            if (value)
                arr.push({
                    'name': name,
                    'value': value
                });
        },

        getPropertiesActiveFile: function() {
            this.propertiesActiveFile = [];
            src = this.activeFileElem.src;
            arr = src.split('/');
            file = arr.pop();

            vm = this;
            axios({
                'method': 'post',
                'url': this.disk + '/getPropertiesFile/' + this.folder,
                'data': {
                    'file': file
                    }
                })
                .then(function (response) {
                    vm.propertiesActiveFile = [];
                    vm.setProperty(vm.propertiesActiveFile, 'Имя', decodeURI(file));
                    vm.setProperty(vm.propertiesActiveFile, 'Снято', response.data['DateTimeOriginal']);
                    vm.setProperty(vm.propertiesActiveFile, 'Камера', response.data['Model']);
                })
                .catch(function (error) {
                    vm.propertiesActiveFile = [];
                    vm.setProperty(vm.propertiesActiveFile, 'Имя', decodeURI(file));
                    console.log(error);
                })





        },

        setActiveFile: function (event) {
            let elem = event.target;

            if (elem) {
                this.activeFileId = elem.id;
                this.activeFileElem = elem;
                this.getPropertiesActiveFile();

            } else {
                this.activeFileId = -1;
                this.activeFileElem = null;
                this.propertiesActiveFile = [];
            }
        },

        setActiveDirectory: function (event) {
            let elem = event.target;
            this.activeDirectoryId = elem ? elem.id : -1;
        }
    }
});