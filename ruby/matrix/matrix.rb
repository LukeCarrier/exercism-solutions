class Matrix
  attr_reader :rows, :columns

  def initialize(matrix)
    @values = []
    matrix.lines.each do |row|
      @values.append(row.split.map { |v| v.to_i })
    end
  end

  def rows
    @values
  end

  def columns
    @values.transpose
  end
end
