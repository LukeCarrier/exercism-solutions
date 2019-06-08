use std::fmt;

const HOURS_IN_DAY: u32 = 24;
const MINUTES_IN_HOUR: u32 = 60;
const MINUTES_IN_DAY: u32 = HOURS_IN_DAY * MINUTES_IN_HOUR;

#[derive(Debug, Clone, Copy, PartialEq)]
pub struct Clock {
    pub hours: u32,
    pub minutes: u32,
}

impl Clock {
    pub fn new(hours: i32, minutes: i32) -> Self {
        let mut total_minutes = hours * 60 + minutes;
        if total_minutes < 0 {
            total_minutes =
                    total_minutes % MINUTES_IN_DAY as i32
                    + MINUTES_IN_DAY as i32;
        }

        let hours = (total_minutes / MINUTES_IN_HOUR as i32) % HOURS_IN_DAY as i32;
        let minutes = total_minutes % MINUTES_IN_HOUR as i32;

        Self {
            hours: hours as u32,
            minutes: minutes as u32,
        }
    }

    pub fn add_minutes(&self, minutes: i32) -> Self {
        Self::new(self.hours as i32, self.minutes as i32 + minutes)
    }
}

impl fmt::Display for Clock {
    fn fmt(&self, f: &mut fmt::Formatter) -> fmt::Result {
        write!(f, "{:02}:{:02}", self.hours, self.minutes)
    }
}
