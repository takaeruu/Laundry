 <div class="col-lg-6 grid-margin stretch-card">
   <div class="card">
     <div class="card-body">
       <h4 class="card-title">Log Activity</h4>
       <a href="<?= base_url('home/hapus_aktivitas') ?>">
         <button class="btn btn-danger">
           <i class="now-ui-icons ui-1_check"></i> Delete
         </button>
       </a>
       <div class="table-responsive">
         <table class="table">
           <thead>
             <tr>
               <th>ID User</th>
               <th>Menu</th>
               <th>Waktu</th>
             </tr>
           </thead>
           <tbody>
             <?php foreach ($activities as $activity): ?>
               <tr>
                 <td><?= $activity['id_user'] ?></td>
                 <td><?= $activity['menu'] ?></td>
                 <td><?= $activity['created_at'] ?></td>
               </tr>
             <?php endforeach; ?>
           </tbody>
         </table>
       </div>
     </div>
   </div>
 </div>