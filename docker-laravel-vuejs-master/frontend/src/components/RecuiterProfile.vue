<template>
    <div>
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img
                            class="rounded-circle mt-5" width="150px"
                            src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span
                            class="font-weight-bold">Edogaru</span><span
                            class="text-black-50">edogaru@mail.com.my</span><span> </span></div>
                </div>
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Configurações do Perfil</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">Nome</label><input type="text"
                                    class="form-control" placeholder="example" value=""></div>
                            <div class="col-md-6"><label class="labels">Razão social</label><input type="text"
                                    class="form-control" value="" placeholder="example"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Celular</label><input type="text"
                                    class="form-control" placeholder="enter phone number" value=""></div>
                                    <div class="col-md-12"><label class="labels">Email ID</label><input type="text"
                                            class="form-control" placeholder="enter email id" value=""></div>
                            <div class="col-md-12"><label class="labels">Endereço</label><input type="text"
                                    class="form-control" placeholder="enter address line 1" value=""></div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6"><label class="labels">Country</label><input type="text"
                                    class="form-control" placeholder="country" value=""></div>
                            <div class="col-md-6"><label class="labels">State/Region</label><input type="text"
                                    class="form-control" value="" placeholder="state"></div>
                        </div>
                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save
                                Profile</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'RecruiterProfile',
    components: {
    }
}
</script>

<style scoped>

.form-control:focus {
    box-shadow: none;
    border-color: #4ea1db;
}

.profile-button {
    background: #4ea1db;
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #124366
}

.profile-button:focus {
    background: #4ea1db;
    box-shadow: none
}

.profile-button:active {
    background: #4ea1db;
    box-shadow: none
}

.back:hover {
    color: #4ea1db;
    cursor: pointer
}

.labels {
    font-size: 11px
}

.add-experience:hover {
    background: #4ea1db;
    color: #fff;
    cursor: pointer;
    border: solid 1px #4ea1db;
    transition: 0.5s;   
}
</style>