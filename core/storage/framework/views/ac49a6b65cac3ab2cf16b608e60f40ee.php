<style>
    div#dailytasks {
        position: fixed;
        top: 0;
        right: 0;
        width: 100%;
        height: 100vh;
        overflow-y: auto;
        background: #2a2e3f;
        max-width: 410px;
        z-index: 99999999;
        transition: all 0.2s ease-in-out;
        border-left: 1px solid hsl(0deg 0% 100% / 18%);
        box-shadow: 1px 1px 2px 3px #2a2e3f;
    }

    body:not(.dark-theme) div#dailytasks {
        background: #fff;
        box-shadow: 0 0 1px 4px hsla(0, 0%, 100%, .1);
    }

    div#dailytasks_holder h3 {
        text-align: center;
        font-size: 1rem;
        padding: 6px;
        font-weight: 600;
        margin-bottom: 25px;
    }

    div#dailytasks_holder div {
        position: relative;
    }

    div#dailytasks_holder div button {
        position: absolute;
        right: 0;
        top: 0;
        background: transparent;
        color: #fff;
        font-size: 2rem;
        padding: 0;
        margin: 0 10px 5px 0;
        box-shadow: none;
        outline: 0;
        border: 0;
    }

    body:not(.dark-theme) div#dailytasks_holder div button {
        color: #000;
    }

    .task-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 5px;
        margin: 5px;
        background: #383d52;
        border-radius: 6px;
        font-size: 0.8rem;
    }


    body:not(.dark-theme) .task-card {
        background: #fff;
        box-shadow: 1px 1px 1px #dddddd8f, -1px -1px 1px #ddd9;
    }

    .task-card p {
        margin: 5px;
    }

    .task-card a {
        text-decoration: none;
        background: aliceblue;
        padding: 5px 15px;
        border-radius: 5px;
        font-size: 1rem;
        font-weight: 600;
    }
</style>

<div id="dailytasks" style="display: none">
    <div id="dailytasks_holder">
    </div>
</div>

<script>
    $(document).ready(function() {
        $.ajax({
            url: "<?php echo e(route('dailytasks')); ?>",
            type: "GET",
            success: function(res) {
                $('#dailytasks_holder').html(res.view);
            }
        });


    });

    function closeDailyTasks() {
        $('#dailytasks').hide('slow');
    }

    function openDailyTasks() {
        $('#dailytasks').show('slow');
    }
</script>
<?php /**PATH /home/xapphfem/v1.xapps.store/core/Modules/DailyTasks/Resources/views/holder.blade.php ENDPATH**/ ?>