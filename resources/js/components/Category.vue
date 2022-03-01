<template>
    <div>
     <Navbar/>
<div class="wrapper">
 

  <div class="content-wrapper">
      <div class="container">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                   
                    <th>Created At</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for='cat in categories' :key='cat.id'>
                    <td>{{cat.id}}</td>
                    <td>{{cat.name}}
                    </td>
                   
                    <td>{{cat.created_at}}</td>
                  
                  </tr>
                  
                
                  </tbody>
          
                </table>
              </div>
              <!-- /.card-body -->
            </div>

    </div>
    </div>
</div>
    </div>

</template>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
<script>

 $(document).ready(function() {
    $('#example').DataTable();
});


import Navbar from './Navbar.vue'
    export default {
        components:{
            Navbar
        },
      data() {
            return {
                categories: [],
              
            }
        },
        methods: {
            showBlogs: function () {
               let tokenStr = localStorage.getItem("access_token");
                 this.axios
                    .get('http://localhost:8000/api/all_categories', {
                headers: {
                    "Authorization": `Bearer ${tokenStr}`
                }
            }).then(function (res) {
                    console.log(res.data.data);
                    if(res.data.status==true)
                    {
                      this.categories = res.data.data;
                    console.log(this.categories);
                    }
                    
                }.bind(this));
            }
        },
        created: function () {
            this.showBlogs()
        }
    }

</script>