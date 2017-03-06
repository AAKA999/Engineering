package com.example.gk.medi;

import android.app.AlarmManager;
import android.app.PendingIntent;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.widget.ToggleButton;

import com.android.volley.AuthFailureError;
import com.android.volley.DefaultRetryPolicy;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.gk.medi.Adaptor.RvAdapter;
import com.example.gk.medi.Arraylist.Person;
import com.example.gk.medi.Util.Util;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.HashMap;
import java.util.Map;
import java.util.StringTokenizer;

public class Schedule extends AppCompatActivity {
    public static ArrayList<Person> personList;
    Calendar calendar = Calendar.getInstance();
    JSONArray jr;
    Intent myIntent;
    AlarmManager alarmManager;
    private PendingIntent pendingIntent;
    private static Schedule inst;
    String first,YYYY,MM,DD;
    private String crtYYYY,crtMM,crtDD,crthh,crtmm;
    String second;
    String Hour;
    String Minute;
    String alarmdate;
    String alarmtime;
    private String alarmText;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_schedule);

        RecyclerView rv = (RecyclerView)findViewById(R.id.recycler_view);
        alarmManager = (AlarmManager) getSystemService(ALARM_SERVICE);
        rv.setHasFixedSize(true);
        LinearLayoutManager llm = new LinearLayoutManager(this);
        rv.setLayoutManager(llm);
        personList=new ArrayList<Person>();
        final RvAdapter rvAdapter = new RvAdapter(personList);
        rv.setAdapter(rvAdapter);

        Calendar c = Calendar.getInstance();
        System.out.println("Current time => " + c.getTime());

        SimpleDateFormat df = new SimpleDateFormat("yyyy-MM-dd-kk-mm");
        String formattedDate = df.format(c.getTime());
        Log.e("Date", formattedDate);

        StringTokenizer tokens = new StringTokenizer(formattedDate,"-");
        crtYYYY = tokens.nextToken();// this will contain "Fruit"
        crtMM = tokens.nextToken();
        crtDD = tokens.nextToken();
        crthh = tokens.nextToken();
        crtmm = tokens.nextToken();
        Log.e("crtYYYY",crtYYYY);
        Log.e("crtMM",crtMM);
        Log.e("crtDD",crtDD);
        Log.e("crthh",crthh);
        Log.e("crtmm",crtmm);

        if (pendingIntent!=null)
        {
            pendingIntent.cancel();
            alarmManager.cancel(pendingIntent);
            setAlarmText("");
            Log.e("Schedule", "Alarm Off");
        }
        else {
            Log.e("Schedule","No pending intent");
        }

        StringRequest stringRequest = new StringRequest(Request.Method.POST, Util.IP+"schedule.php",
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {

                        Log.e("onResponse", response);
                        try {
                            personList.clear();
                            jr=new JSONArray(response);
                            for (int i=0;i<jr.length();i++) {

                                Person person = new Person();
                                JSONObject js = jr.getJSONObject(i);
                                person.id=js.getString("id");
                                person.latest_med_name=js.getString("latest_med_name");
                                person.date=js.getString("date");
                                alarmdate=person.date;
                                getSeparateDate(alarmdate);
                                person.time=js.getString("time");
                                alarmtime=person.time;
                                getSeparateTime(alarmtime);
                                person.taken=js.getString("taken");
                                person.to_be_taken=js.getString("to_be_taken");
                                person.missed=js.getString("missed");
                                personList.add(i, person);
                                SetAlarm();

                                setAlarmText(person.id);
                            }
                            rvAdapter.notifyDataSetChanged();

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.e("TAG", "volley error");
                //Toast.makeText(LogIn.this,error.toString(),Toast.LENGTH_LONG ).show();
            }
        }){
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                SharedPreferences sp1 = getSharedPreferences("id", Context.MODE_PRIVATE);
                String id = sp1.getString("id","");
                Log.e("id",id);
                Map<String, String> params = new HashMap<String, String>();
                params.put("id", id);
                return params;
            }
        };
        stringRequest.setRetryPolicy(new DefaultRetryPolicy(
                5000,
                DefaultRetryPolicy.DEFAULT_MAX_RETRIES,
                DefaultRetryPolicy.DEFAULT_BACKOFF_MULT));
        RequestQueue requestQueue= Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }


    public static Schedule instance() {
        return inst;
    }
    @Override
    public void onStart()
    {
        super.onStart();
        inst = this;
    }
    public void SetAlarm()
    {
        if (!alarmtime.equals(""))
        {
            if (Integer.parseInt(crtYYYY)<=Integer.parseInt(YYYY)&&Integer.parseInt(crtMM)<=Integer.parseInt(MM)&&Integer.parseInt(crtDD)<=Integer.parseInt(DD))
            {
                if (Integer.parseInt(crthh)<=Integer.parseInt(first))
                {
                    if (Integer.parseInt(crtmm)<=Integer.parseInt(second))
                    {
                        Log.e("MyActivity", "Alarm On");
                        /*calendar.set(Calendar.YEAR, Integer.parseInt(YYYY));
                        calendar.set(Calendar.MONTH, Integer.parseInt(MM));
                        calendar.set(Calendar.DAY_OF_MONTH, Integer.parseInt(DD));*/
//                        calendar.set(Calendar.DA
// ]\TE, Integer.parseInt(alarmdate));
                        calendar.set(Calendar.HOUR_OF_DAY, Integer.parseInt(first));
                        calendar.set(Calendar.MINUTE, Integer.parseInt(second));
                        myIntent = new Intent(Schedule.this, AlarmReceiver.class);
                        pendingIntent = PendingIntent.getBroadcast(Schedule.this, 0, myIntent, 0);
                        alarmManager.set(AlarmManager.RTC, calendar.getTimeInMillis(),pendingIntent);
                    }
                }

            }
        }
        else
        {
            Log.e("ERROR","Alarm time is Null");
        }
    }
    public void ClearPendding()
    {

    }

    public void setAlarmText(String alarmText) {
        this.alarmText = alarmText;
    }
    public void getSeparateTime(String time)
    {
        StringTokenizer tokens = new StringTokenizer(time,":");
        first = tokens.nextToken();// this will contain "Fruit"
        second = tokens.nextToken();
        Log.e("Hour",first);
        Log.e("Minute",second);
    }
    public void getSeparateDate(String date)
    {
        StringTokenizer tokens = new StringTokenizer(date,"-");
        YYYY = tokens.nextToken();// this will contain "Fruit"
        MM = tokens.nextToken();
        DD = tokens.nextToken();
        Log.e("YYYY",YYYY);
        Log.e("MM",MM);
        Log.e("DD",DD);
    }
}