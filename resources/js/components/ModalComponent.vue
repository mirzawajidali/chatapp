<template>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <form action="">
            <input type="file">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
        </form>

      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
    mounted(){
        console.log('modal component mounted');
    }
}
</script>
<style scoped>
.modal-content{
    border-radius: 0% !important;
}
</style>
