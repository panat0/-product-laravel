<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ChirpController extends Controller
{


    // 1
    public function index(): Response
    {
        return Inertia::render('Chirps/Index', [
            'chirps' => Chirp::with('user:id,name')->latest()->get(),
        ]);
    }
    /**แสดงรายการ Chirps ทั้งหมด
    การใช้งาน:
    ดึงข้อมูล Chirps ทั้งหมดจากฐานข้อมูล โดยใช้ Chirp::with('user:id,name')->latest()->get()
    with('user:id,name') โหลดข้อมูลผู้ใช้ที่สร้าง Chirp (เฉพาะ id และ name)
    เรียงลำดับจากใหม่ไปเก่า (latest())
    ส่งข้อมูลไปยังหน้า Chirps/Index ผ่าน Inertia.js

     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $request->user()->chirps()->create($validated);

        return redirect(route('chirps.index'));
    }
    //หน้าที่: บันทึก Chirp ใหม่ที่ผู้ใช้ส่งมา
    //การทำงาน:
    //ตรวจสอบข้อมูล (validate) ว่ามี message ที่ไม่เกิน 255 ตัวอักษร
    //บันทึกข้อมูลโดยใช้ user()->chirps()->create($validated) ซึ่งเชื่อมกับโมเดลผู้ใช้ที่ล็อกอินอยู่
    //หลังจากบันทึกเสร็จ ให้ redirect ไปที่ chirps.index เพื่อแสดงรายการ Chirps อีกครั้ง

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        Gate::authorize('update', $chirp);

        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $chirp->update($validated);

        return redirect(route('chirps.index'));
    }
    /*
    หน้าที่: อัปเดตข้อความของ Chirp
    การทำงาน:
    ใช้ Gate::authorize('update', $chirp) เพื่อตรวจสอบสิทธิ์ว่าผู้ใช้มีสิทธิ์แก้ไข Chirp นี้หรือไม่
    ตรวจสอบข้อมูล (validate) ให้ตรงตามเงื่อนไข
    อัปเดตข้อมูล Chirp โดยใช้ $chirp->update($validated)
    หลังจากอัปเดตเสร็จ ให้ redirect กลับไปที่ chirps.index
    */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        Gate::authorize('delete', $chirp);

        $chirp->delete();

        return redirect(route('chirps.index'),                                                   );
    }
}
    /*
    หน้าที่: ลบ Chirp ที่ระบุ
    การทำงาน:
    ใช้ Gate::authorize('delete', $chirp) เพื่อตรวจสอบสิทธิ์ว่าผู้ใช้มีสิทธิ์ลบ Chirp นี้หรือไม่
    ลบ Chirp โดยใช้ $chirp->delete()
    Redirect กลับไปที่ chirps.index หลังจากลบเสร็จ
    */

