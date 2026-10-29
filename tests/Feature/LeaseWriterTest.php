<?php
namespace Tests\Feature;
use Tests\TestCase;
use App\Models\Lease;
use App\Services\LeaseWriter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;

class LeaseWriterTest extends TestCase
{
 use RefreshDatabase;
 public function test_overlap_is_rechecked_at_the_write_boundary(): void {
  $first=Lease::factory()->create(['start_date'=>'2030-01-01','end_date'=>'2030-06-30']);
  $this->expectException(ValidationException::class);
  app(LeaseWriter::class)->save(['unit_id'=>$first->unit_id,'tenant_id'=>$first->tenant_id,'start_date'=>'2030-06-01','end_date'=>'2030-08-01','rent'=>1000]);
 }
 public function test_nonoverlapping_period_can_be_saved(): void {
  $first=Lease::factory()->create(['start_date'=>'2030-01-01','end_date'=>'2030-06-30']);
  app(LeaseWriter::class)->save(['unit_id'=>$first->unit_id,'tenant_id'=>$first->tenant_id,'start_date'=>'2030-07-01','end_date'=>null,'rent'=>1000]);
  $this->assertDatabaseCount('leases',2);
 }
}
