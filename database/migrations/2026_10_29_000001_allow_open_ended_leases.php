<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration {
 public function up(): void { Schema::table('leases',fn(Blueprint $table)=>$table->date('end_date')->nullable()->change()); }
 public function down(): void {
  if(DB::table('leases')->whereNull('end_date')->exists()) throw new RuntimeException('Resolve open-ended leases before rollback.');
  Schema::table('leases',fn(Blueprint $table)=>$table->date('end_date')->nullable(false)->change());
 }
};
