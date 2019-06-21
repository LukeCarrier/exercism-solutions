using System;

public class SpaceAge
{
    private const double EARTH_ORBIT_SECONDS = 31557600.0;
    private const double MERCURY_ORBIT_EARTH_YEARS = 0.2408467;
    private const double VENUS_ORBIT_EARTH_YEARS = 0.61519726;
    private const double MARS_ORBIT_EARTH_YEARS = 1.8808158;
    private const double JUPITER_ORBIT_EARTH_YEARS = 11.862615;
    private const double SATURN_ORBIT_EARTH_YEARS = 29.447498;
    private const double URANUS_ORBIT_EARTH_YEARS = 84.016846;
    private const double NEPTUNE_ORBIT_EARTH_YEARS = 164.79132;

    private int seconds;

    public SpaceAge(int seconds)
    {
        this.seconds = seconds;
    }

    public double OnEarth() => seconds / EARTH_ORBIT_SECONDS;

    public double OnMercury() => OnEarth() / MERCURY_ORBIT_EARTH_YEARS;
    public double OnVenus() => OnEarth() / VENUS_ORBIT_EARTH_YEARS; 
    public double OnMars() => OnEarth() / MARS_ORBIT_EARTH_YEARS;
    public double OnJupiter() => OnEarth() / JUPITER_ORBIT_EARTH_YEARS;
    public double OnSaturn() => OnEarth() / SATURN_ORBIT_EARTH_YEARS;
    public double OnUranus() => OnEarth() / URANUS_ORBIT_EARTH_YEARS;
    public double OnNeptune() => OnEarth() / NEPTUNE_ORBIT_EARTH_YEARS;
}
