<script>
    export default {
        data() {
            return {
                purging: false,
                showExportModal: false
            }
        },
        methods: {
            purgeList() {
                if (confirm('Er du sikker på du vil rydde listen?')) {
                    this.purging = true;
                    window.location = '/companies/purge'
                }
            }
        }
    }
</script>
