<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSysStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_stores', function (Blueprint $table) {
            $table->id();
            $table->string('store_code')->nullable();
            $table->string('store_type_code')->nullable();
            $table->string('owner_type')->nullable();
            $table->integer('frc_owner_id')->nullable();
            $table->integer('company_branch_id')->nullable();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('state_province')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('phone_num')->nullable();
            $table->string('fax_num')->nullable();
            $table->string('tax_office_code')->nullable();
            $table->string('tax_registration_num')->nullable();
            $table->string('taxable_business_owners_flag')->nullable();
            $table->string('tbo_registration_num')->nullable();
            $table->date('tbo_registration_date')->nullable();
            $table->string('tbo_address1')->nullable();
            $table->string('tbo_address2')->nullable();
            $table->string('corporate_flag')->nullable();
            $table->string('active_flag')->nullable();
            $table->date('active_date')->nullable();
            $table->date('inactive_date')->nullable();
            $table->date('creation_date')->nullable();
            $table->integer('created_by')->nullable();
            $table->date('last_update_date')->nullable();
            $table->integer('last_update_by')->nullable();
            $table->integer('tax_pkp_id')->nullable();
            $table->string('convenience_flag')->nullable();
            $table->integer('cdc_bank_account_id')->nullable();
            $table->string('default_sup_site_code')->nullable();
            $table->string('bca_use_reg_acc')->nullable();
            $table->date('bca_flag_active_date')->nullable();
            $table->integer('ps_min_share_amt')->nullable();
            $table->string('ps_kprk_vendor_num')->nullable();
            $table->string('ps_kprk_vendor_site_code')->nullable();
            $table->string('ppn_ioa_flag')->nullable();
            $table->string('flag_central_lapor_pph')->nullable();
            $table->string('nama_kpp_lapor_pph')->nullable();
            $table->string('nama_franchisee')->nullable();
            $table->string('alamat_npwp')->nullable();
            $table->string('kota_npwp')->nullable();
            $table->string('nama_pemilik')->nullable();
            $table->string('npwp_pemilik')->nullable();
            $table->string('server')->nullable();
            $table->integer('nilai_sps')->nullable();
            $table->date('tgl_mulai')->nullable();
            $table->date('tgl_selesai')->nullable();
            $table->string('branch_code')->nullable();
            $table->string('flag_sps')->nullable();
            $table->date('start_date_sps')->nullable();
            $table->date('end_date_sps')->nullable();
            $table->string('jenis_usaha')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('tipe_pelapor')->nullable();
            $table->string('kode_klu')->nullable();
            $table->string('kantor_akuntan')->nullable();
            $table->string('npwp_kantor_akuntan')->nullable();
            $table->string('nama_akuntan')->nullable();
            $table->string('npwp_akuntan')->nullable();
            $table->string('kantor_konsu')->nullable();
            $table->string('npwp_kantor_konsultan')->nullable();
            $table->string('nama_konsultan')->nullable();
            $table->string('npwp_konsultan')->nullable();
            $table->integer('parent_stores_id')->nullable();
            $table->integer('parent_branch_id')->nullable();
            $table->string('parent_store_code')->nullable();
            $table->string('store_code_new')->nullable();
            $table->string('nm_kel')->nullable();
            $table->string('nm_kec')->nullable();
            $table->string('nm_kab')->nullable();
            $table->string('metode_penyusutan')->nullable();
            $table->date('start_date_se')->nullable();
            $table->date('end_date_se')->nullable();



      
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_stores');
    }
}
