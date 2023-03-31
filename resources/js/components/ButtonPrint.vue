<template>
    <button @click="print" :class="class" :style="loading ? 'opacity: 0.5;cursor: not-allowed;' : 'opacity: 1;cursor: pointer;'" :disabled="loading">
        <span v-if="!loading">{{ label }}</span>
        <img v-else src="/images/oval.svg" class="w-4"/>
    </button>
</template>
<script>
import axios from 'axios';
export default {
  props: {
    urlFile: {
        type: Object,
        required: true
    },
    method: {
        type: String,
        default: 'GET'
    },
    label: {
        type: String,
        default: 'Imprimir'
    },
    class: {
        type: String,
        required: true
    }
  },
  data () {
    return {
        loading: false
    }
  },
  methods: {
    print()
    {
        this.loading = true;
        axios({
            url: this.urlFile,
            method: 'GET',
            responseType: 'arraybuffer',
        }).then((response) => {
             const file = new Blob([response.data], { type: 'application/pdf' });
            const fileURL = URL.createObjectURL(file);
            const iframe = document.createElement('iframe');
            iframe.src = fileURL;
            iframe.style.display = 'none';
            document.body.appendChild(iframe);
            iframe.onload = () => {
                iframe.contentWindow.print();
                this.loading = false;
                URL.revokeObjectURL(fileURL);
            };
        }).finally(() => {
            this.loading = false;
        });
    }

  }
}
</script>
