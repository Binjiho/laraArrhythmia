<style>
    #spinner-div {
        position: fixed;
        display: none;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        text-align: center;
        background-color: rgba(255, 255, 255, 0.8);
        z-index: 9999;
    }

    #spinner-div div {
        position: relative;
        top: 45%;
    }
</style>

<div id="spinner-div">
    <div class="spinner-border text-primary" role="status"></div>
</div>
