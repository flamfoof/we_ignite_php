<style media="screen">
    .so-editor{
        position: fixed;
        top: 50%;
        left: 0;
        width: 50px;
        height: 50px;
        background: black;
        padding: 10px;
        z-index: 99999999999999;
        -webkit-box-shadow: 0px 0px 5px 2px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 0px 5px 2px rgba(0,0,0,0.75);
        box-shadow: 0px 0px 5px 2px rgba(0,0,0,0.75);
        transition: 0.5s all ease;
        overflow-x: hidden;
    }
    .so-editor:hover{
        width: auto;
        overflow-x: auto;
        transition: 1s all ease;
    }
    .so-editor.open{
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: auto;
        background: black;
        padding: 10px;
        z-index: 99999999999999;
        overflow-x: auto;
        -webkit-box-shadow: 0px 0px 5px 2px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 0px 5px 2px rgba(0,0,0,0.75);
        box-shadow: 0px 0px 5px 2px rgba(0,0,0,0.75);
        transition: 0.5s all ease;
    }
    .so-editor .wrap{
        display: none;
    }
    .so-editor.open .wrap{
        display: flex;
    }
    .so-editor.open span{
        display: none;
    }
    .editlement,
    .editlement-image{
        border: 1px silver dashed;
        padding: 5px;
    }
    .editlement-selected,
    .editlement-image-selected{
        background: silver;
    }
    .image-selectable.selected{
        background: blue;
        padding: 4px;
    }
</style>
