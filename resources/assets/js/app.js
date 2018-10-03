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
        files: [],
        folders: [],
        activeFileIndex: -1,
        activeDirectoryIndex: -1,
        propertiesActiveFile: [],
        readyFolders: false,
        readyFiles: false,
    },

    created: function () {
        path = decodeURI(window.location.pathname);
        arr = path.split('/storage');
        this.disk = arr[0];
        if(arr.length > 0)
            this.folder = arr[1].slice(1);
        this.getFolders();
        this.getFiles();
    },

    methods: {

        getFolders: function() {
            vm = this;
            vm.readyFolders = false;
            axios({
                'method': 'post',
                'url': this.disk + '/getFoldersJson/' + this.folder,

            }).then(function (response) {
                vm.folders = response.data;
                vm.readyFolders = true;

            }).catch(function (error) {
                vm.folders = [];
                vm.readyFolders = truel
            })

        },

        getFiles: function() {
            vm = this;
            vm.readyFiles = false;
            axios({
                'method': 'post',
                'url': this.disk + '/getFilesJson/' + this.folder,

            }).then(function (response) {
                vm.files = response.data;
                vm.readyFiles = true;

            }).catch(function (error) {
                vm.files = [];
                vm.readyFiles = true;
            })

        },

        setProperty: function(arr, name, value) {
            if (value)
                arr.push({
                    'name': name,
                    'value': value
                });
        },

        setActiveFile: function (event) {
            let elem = event.target;

            if (elem) {
                this.activeFileIndex = elem.getAttribute("data-index");
                this.getPropertiesActiveFile();

            } else {
                this.activeFileIndex = -1;
                this.propertiesActiveFile = [];
            }
        },

        setActiveDirectory: function (event) {
            let elem = event.target;
            this.activeDirectoryIndex = elem ? elem.getAttribute("data-index") : -1;
        },

        getPropertiesActiveFile: function() {
            //this.propertiesActiveFile = [];
            if (this.activeFileIndex < 0) {
                return;
            }

            url = decodeURI(this.files[this.activeFileIndex].urlImage);
            arr = url.split('/');
            file = arr.pop();

            vm = this;
            axios({
                'method': 'post',
                'url': this.disk + '/getPropertiesFile/' + this.folder,
                'data': {
                    'file': file
                }

            }).then(function (response) {
                vm.propertiesActiveFile = [];
                vm.setProperty(vm.propertiesActiveFile, 'Имя', file);
                vm.setProperty(vm.propertiesActiveFile, 'Снято', response.data['DateTimeOriginal']);
                vm.setProperty(vm.propertiesActiveFile, 'Камера', response.data['Model']);

            }).catch(function (error) {
                vm.propertiesActiveFile = [];
                vm.setProperty(vm.propertiesActiveFile, 'Имя', file);
            })
        },

    }
});